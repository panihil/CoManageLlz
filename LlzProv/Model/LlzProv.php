<?php
 

class LlzProv extends AppModel {
  // Required by COmanage Plugins
  public $cmPluginType = "provisioner";

  // Expose Menu Items
  public $cmPluginMenus = array();
  
  // Document foreign keys
  //public $cmPluginHasMany = array(
  //  "CoPerson" => array("CoLdapProvisionerDn")
  //);
}
