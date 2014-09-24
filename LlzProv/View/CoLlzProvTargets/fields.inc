

<?php
  // Determine if fields are editable
  $e = false;
  
  if(($this->action == "add" && $permissions['add']) || ($this->action == "edit" && $permissions['edit']))
    $e = true;
    
  // We shouldn't get here if we don't have at least read permission, but check just in case
  
  if(!$e && !$permissions['view'])
    return false;
  
  print $this->Form->hidden('co_id', array('default' => $cur_co['Co']['id'])) . "\n";
  print $this->Form->hidden('co_provisioning_target_id', array('default' => $vv_ptid)) . "\n";
  
?>
<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
  <p>
    <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
    <strong><?php print _txt('pl.llzprov.info'); ?></strong>
  </p>
</div>
<br />
<table id="<?php print $this->action; ?>_co_llz_prov_target" class="ui-widget">
  <tbody>
    <tr class="line1">
      <td>
        <?php print _txt('pl.llzprov.t1'); ?><font class="required">*</font><br />
        <font class="desc"><?php   ?></font>
      </td>
      <td>
        <?php print ($e ? $this->Form->input('t1',  array('type' => 'textarea', 'rows'=>'6', 'cols' => '64')) : Sanitize::html($co_grouper_provisioner_targets[0]['CoLlzProvTarget']['t1'])); ?>
      </td>
    </tr>
    <tr class="line2">
       <td>
        <?php print _txt('pl.llzprov.t2'); ?><font class="required">*</font><br />
        <font class="desc"><?php   ?></font>
      </td>
      <td>
        <?php print ($e ? $this->Form->input('t2',  array('type' => 'textarea', 'rows'=>'6', 'cols' => '64')) : Sanitize::html($co_grouper_provisioner_targets[0]['CoLlzProvTarget']['t2'])); ?>
      </td>
    </tr>
    
    <tr>
      <td>
        <i><font class="required"><?php print _txt('fd.req'); ?></font></i><br />
      </td>
      <td>
        <?php
          if($e) {
            echo $this->Form->submit($submit_label);
            print $this->Form->button(_txt('op.reset'), 
                                      array('type'=>'reset'));
          }
        ?>
      </td>
    </tr>
  </tbody>
</table>
