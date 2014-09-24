<?php
App::uses("CoProvisionerPluginTarget", "Model");

class CoLlzProvTarget extends CoProvisionerPluginTarget {

  // Define class name for cake
  public $name = "CoLlzProvTarget";
  
  // Add behaviors
  public $actsAs = array('Containable');
 
    // Association rules from this model to other models
  public $belongsTo = array("CoProvisioningTarget");
  
   public $validate = array(
    'co_provisioning_target_id' => array(
      'rule' => 'numeric',
      'required' => true,
      'message' => 'A CO Provisioning Target ID must be provided'
    )
    );
  
   /*
   * the provisioning data comming in is filtered... may want to replace it with a fresh 
   * query. For example, the extended attributes are not included, and the roles are filtered by date.
   */
    public function provision($coProvisioningTargetData, $op, $provisioningData) 
    {
           
        if( $op != 'PD' && $op != 'PG' && $op != 'PX' && $op != 'PR' && $op != 'PY' && $op != 'PU' )
        return true; // we are not doing groups at this point.        
         
        /* because sometimes a role gets filtered out (by date) by the calling context and array not reordered.
        Php does this weird thing where arrays have indexes and can get screwed up when you remove something. E.g.,
        indexes 0,1,2 become 0,2 if you removed the second element. Stoopid, right? Anyway this makes json_encode 
        do weird stuff. So to fix, we create a new array made from elements of what was provided.
        */      
        $provisioningData['CoPersonRole'] = array_values($provisioningData['CoPersonRole']);
        
        $pd = print_r($provisioningData, true);
        $ptd = print_r($coProvisioningTargetData, true);
        
        CakeLog::write('debug', 'provisioning called OPERATION:' . $op . '  Provisioning Data:' . $pd . '  coProvisioningTargetData:' . $ptd   );
        
        $jpd = json_encode( $provisioningData );
        
        // CakeLog::write('debug', 'As JSON ' .  $jpd  );
        // T1 holds the begining of the command string.
        $cmd = $coProvisioningTargetData['CoLlzProvTarget']['t1']."OP=".$op."\&pd=".urlencode($jpd);     
        CakeLog::write('debug', 'COmmand ' . $cmd );
        $output = array();
        $ret = null;
        
        $last_line = exec( $cmd, $output, $ret );
        $out = print_r($output, true);
        
        /* Gotta figure a better interface with provisioning service provider. This is fugly. */
        if( $ret != 0 ) return false;
        else
        if( strlen( $last_line ) < 1 || substr_count($last_line, "Success" ) < 1 ) return false;
            else return true;
        $retCode = false;    
    }
   
/*******************************/   
    public function status($coProvisioningTargetId, $coPersonId, $coGroupId=null) 
    {
        $ret = array(
        'status'    => ProvisioningStatusEnum::Unknown,
        'timestamp' => null,
        'comment'   => "FISH STICKS"
        );
        
        $args = array();
         
        $cp = new CoPerson();
        $p  =  $cp->findById($coPersonId);
        $ids = $p['Identifier'];
        
        $args['conditions']['co_provisioning_target_id'] = $coProvisioningTargetId;
        $lpt = new CoLlzProvTarget();
        $pt = $lpt->find('first', $args);
        $jpd = json_encode( $p ); 
        $cmd = $pt['CoLlzProvTarget']['t2'].'OP=QP\&'.'pd='.urlencode($jpd);
        
        CakeLog::write('debug', 'CoProvisioningTarget ' . print_r($pt  , true) . "  " . $cmd);
        CakeLog::write('debug', 'CoPerson ' . print_r($ids, true) );
             
        $output = array();
        $ret2 = null;
        
        $last_line = exec( $cmd, $output, $ret2 );
        CakeLog::write('debug', 'Last Line ' . $last_line );
        
        $ret['comment'] = $last_line;
         
        if( substr_count( $last_line, "Not Found" ) > 0 ) 
        {
            $ret['status'] = ProvisioningStatusEnum::NotProvisioned;
            $ret['timestamp'] = null;
        }
        else  if( substr_count( $last_line, "Connection error" ) > 0 ) 
        {
            $ret['status'] = ProvisioningStatusEnum::Unknown;
            $ret['timestamp'] = null;
        }
        else
        {
            // Get the last provision time from the parent status function
            $pstatus = parent::status($coProvisioningTargetId, $coPersonId, $coGroupId);
            
            if($pstatus['status'] == ProvisioningStatusEnum::Provisioned) 
            {
                $ret['timestamp'] = $pstatus['timestamp'];
                $ret['status'] = ProvisioningStatusEnum::Provisioned;
            }
        }
         
        return $ret;
    }
  
}
