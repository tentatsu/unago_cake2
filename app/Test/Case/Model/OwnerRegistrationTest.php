<?php
App::uses('OwnerRegistration', 'Model');

/**
 * OwnerRegistration Test Case
 *
 */
class OwnerRegistrationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.owner_registration'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OwnerRegistration = ClassRegistry::init('OwnerRegistration');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OwnerRegistration);

		parent::tearDown();
	}

}
