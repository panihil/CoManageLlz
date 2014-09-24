<?php
App::uses('CoLlzProvTarget', 'LlzProv.Model');

/**
 * CoLlzProvTarget Test Case
 *
 */
class CoLlzProvTargetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.llz_prov.co_llz_prov_target',
		'plugin.llz_prov.co_provisioning_target',
		'plugin.llz_prov.co',
		'plugin.llz_prov.co_setting',
		'plugin.llz_prov.co_enrollment_flow',
		'plugin.llz_prov.co_group',
		'plugin.llz_prov.co_group_member',
		'plugin.llz_prov.co_person',
		'plugin.llz_prov.co_nsf_demographic',
		'plugin.llz_prov.co_invite',
		'plugin.llz_prov.email_address',
		'plugin.llz_prov.org_identity',
		'plugin.llz_prov.organization',
		'plugin.llz_prov.name',
		'plugin.llz_prov.address',
		'plugin.llz_prov.co_person_role',
		'plugin.llz_prov.cou',
		'plugin.llz_prov.co_petition',
		'plugin.llz_prov.co_petition_attribute',
		'plugin.llz_prov.co_enrollment_attribute',
		'plugin.llz_prov.co_enrollment_attribute_default',
		'plugin.llz_prov.co_petition_history_record',
		'plugin.llz_prov.co_terms_and_conditions',
		'plugin.llz_prov.co_t_and_c_agreement',
		'plugin.llz_prov.history_record',
		'plugin.llz_prov.telephone_number',
		'plugin.llz_prov.co_org_identity_link',
		'plugin.llz_prov.identifier',
		'plugin.llz_prov.co_notification',
		'plugin.llz_prov.co_provisioning_export',
		'plugin.llz_prov.ssh_key',
		'plugin.llz_prov.co_extended_attribute',
		'plugin.llz_prov.co_identifier_assignment',
		'plugin.llz_prov.co_sequential_identifier_assignment',
		'plugin.llz_prov.co_localization',
		'plugin.llz_prov.co_self_service_permission'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CoLlzProvTarget = ClassRegistry::init('LlzProv.CoLlzProvTarget');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CoLlzProvTarget);

		parent::tearDown();
	}

}
