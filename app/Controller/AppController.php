<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('IniReader', 'Configure');
App::uses('AppConst', 'Lib');
App::uses('AppUtility', 'Lib');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {	
	public $components = array(
			'Session',
			'Acl',

			'Auth' => array(
					'loginAction' => array(
							'controller' => 'Home',
							'action' => 'index'
					),
 
  				   'authorize' => array(
                                                            'Actions' => array('actionPath' => 'controllers')
							), 
					'authenticate' => array(
							'AppServer'=>array(
							)
					),
					'className' => 'AppServerAuth'
			),
			'Cookie',
	);
        
	public $pageTitle;
	public $helpers = array('Html','Session','Form','Common');
	public function __construct(CakeRequest $request= null,CakeResponse $response = null){
		parent::__construct($request, $response);
		Configure::config('ini',new IniReader( APP.'Config'.DS));
	}

	public function beforeRender() {
            parent::beforeRender();
            $this->params['prefix'] = false;
        
            if($this->name == 'CakeError'){
                $this->set('title_for_layout',__('Lỗi'));
                $this->layout = "default";
            }	
            
            $this->auth = $this->Auth->user();
            $this->set('auth',$this->auth);
        
	}
	
    /**
     * Overwrite check login and set layout
     * 
     * @edit 08/07/2015
     * @content Check layout view unlogin and login
     */
	function beforeFilter() {
		parent::beforeFilter();
		$this->auth = $this->Auth->user();
		$this->set('auth',$this->auth);
	}

// 	/**
// 	 * This function seting authen
// 	 * 
// 	 * @author PhanVM
// 	 * @create 2015/07/08
// 	 */
// 	protected function settingAuth(){ 
// 		$prefix = isset($this->params['prefix']) ? $this->params['prefix']: '';
// 		if(! $prefix){
// 			$this->Auth->loginAction = '/';
// 			$this->Auth->loginRedirect ='/';
// 			$this->Auth->logoutRedirect = '/';
// 			$this->Auth->accessDeniedUrl = '/403';
// 			return true;
// 		}
		
// 		switch ($prefix) {
// 			case 'admin':
// 				$this->Auth->loginAction = 'admin/Users/login';
// 				$this->Auth->loginRedirect ='/admin';
// 				$this->Auth->logoutRedirect = '/admin';
//                 $this->Auth->accessDeniedUrl = '/403';                
// 				break;
// 			case 'advertiser':
// 				$this->Auth->loginAction = '/publishers/loginScreen';
// 				//$this->Auth->loginRedirect ='/';Ư
// 				$this->Auth->logoutRedirect = '/';
//                 $this->Auth->accessDeniedUrl = '/403';                
// 				break;
// 			case 'publisher':
// 				$this->Auth->loginAction = '/publishers/loginScreen';
// 				//$this->Auth->loginRedirect ='/publishers/loginScreen';
// 				$this->Auth->logoutRedirect = 'publisher';
//                 $this->Auth->accessDeniedUrl = '/403';                
// 				break;	
// 		}
		
// 		return true;
// 	}
}
