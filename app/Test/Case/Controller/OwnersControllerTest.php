<?php
App::uses('OwnersController', 'Controller');

/**
 * OwnersController Test Case
 *
 */
class OwnersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.owner',
		'app.company',
		'app.address',
		'app.pet',
		'app.pet_classification',
		'app.questionnaire'
	);

}
