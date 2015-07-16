<?php
App::uses('DataFb', 'Model');

/**
 * DataFb Test Case
 *
 */
class DataFbTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data_fb'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DataFb = ClassRegistry::init('DataFb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DataFb);

		parent::tearDown();
	}

}
