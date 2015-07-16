<?php
class ErrorsController extends AppController {
	public $name = 'Errors';

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('error404');
		$this->layout = "default";
	}

	public function error404() {
		
	}
}