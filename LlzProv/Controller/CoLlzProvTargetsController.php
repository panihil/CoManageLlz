<?php
//App::uses('LlzProvAppController', 'LlzProv.Controller');
App::uses("SPTController", "Controller");

/**
 * CoLlzProvTargets Controller
 *
 */
class CoLlzProvTargetsController extends SPTController {

      // Class name, used by Cake
  public $name = "CoLlzProvTargets";
  
  // Establish pagination parameters for HTML views
  public $paginate = array(
    'limit' => 25,
    'order' => array(
      'serverurl' => 'asc'
    )
  );
    function isAuthorized() {
    $roles = $this->Role->calculateCMRoles();
     
    // Construct the permission set for this user, which will also be passed to the view.
    $p = array();
    
    // Determine what operations this user can perform
    
    // Delete an existing CO Provisioning Target?
    $p['delete'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    // Edit an existing CO Provisioning Target?
    $p['edit'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    // View all existing CO Provisioning Targets?
    $p['index'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    // View an existing CO Provisioning Target?
    $p['view'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    $this->set('permissions', $p);   
    
    return($p[$this->action]);
  }

}
