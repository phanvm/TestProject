<?php 
App::uses('Sanitize', 'Utility');
class  HomeController extends AppController{
	public $uses = array();
	public function beforeFilter(){
		$this->auth = $this->Auth->user();
	}
	
	public function index(){
		if(!empty($this->auth))
			$this->redirect('/employee-list'); 
		else
			$this->redirect('/');
		exit();
	}
	
	public function login(){
			if(!empty($this->auth))
				$this->redirect('/employee-list');
			
            $this->layout = "login";
            try {
                if ($this->request->is('post')) {
                     	$this->request->data['type'] = AppConst::LOGIN_USER;
                        if ($this->Auth->login()) {
                                $this->redirect('/');
                        } else {
                            $this->Session->setFlash("<div class='invalid-msg'>Your username or password was incorrect.</div>");
                        }
                }
            } catch (Exception $e) {
            	debug($e->getMessage()); die;
                $this->log($e->getMessage(),LOG_ERR);
            }
            
	}
	/**
	 * This function logout()
	 */
	public function logout(){
		$this->Auth->logout();
		$this->redirect('/');
		exit();
	}
}