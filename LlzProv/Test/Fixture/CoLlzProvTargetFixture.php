<?php
/**
 * CoLlzProvTargetFixture
 *
 */
class CoLlzProvTargetFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'co_provisioning_target_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		't1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		't2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'i1' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'cm_co_llz_prov_targets_i1' => array('column' => 'co_provisioning_target_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'co_provisioning_target_id' => 1,
			'created' => 1410810220,
			'modified' => 1410810220,
			't1' => 'Lorem ipsum dolor sit amet',
			't2' => 'Lorem ipsum dolor sit amet',
			'i1' => 1
		),
	);

}
