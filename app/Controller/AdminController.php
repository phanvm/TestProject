<?php
App::uses( "AppConst" , "Lib" );
App::uses("AppUtility", "Lib");
App::uses("Sanitize", "Utility");
App::uses("Validation", "Utility");

/**
 * Class Admin 
 * @author PhanVM
 *
 */
class AdminController extends AppController{
	public $uses = array('User');
	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = "backend";
		$this->auth = $this->Auth->user();
		$this->set('auth',$this->auth);
	}
	
	/**
	 * This function index()
	 * @author PhanVM
	 * @description action for view index
	 * @date 
	 */
	public function index(){
		
	}
	
	/**
	 * This function addEmployee()
	 * @author PhanVM
	 * @description action for view addEmployee
	 */
	public function addEmployee(){
		
		$datas 		= array();
		$validate	= false;
		
		try {
			if($this->request->is("post")){
				
				$validate = $this->validateForm($this->request->data , $_FILES , $datas);
				if( $validate && !empty($datas) ){
					$ext_filename = $datas['username'];
					$is_upload = AppUtility::uploadFile($_FILES,$ext_filename);
					if($is_upload){
						$datas['photo'] = $ext_filename;
						$datas['password']	= $this->Auth->password('123456');
						if($this->saveEmployee($datas)){
							$this->Session->setFlash("Add new successfully!", 'default' , array('class'=>'callout callout-success'));
						}else{
							$this->Session->setFlash("Add false!", 'default' , array('class'=>'callout callout-danger'));
						}
						$this->redirect('/employee-list');
						exit();
					}
				}
			}
		} catch (Exception $e) {
			
		}
	}
	
	
	/**
	 * This function listEmployee()
	 * @author PhanVM
	 * @description action for view listEmployee
	 */
	public function listEmployee(){
		$this->paginate = array(
				'limit' => 10,
				'order' => array('id' => 'desc'),
		);
		
		$list = $this->paginate('User');
		$this->set('list',$list);
	}
	
	/**
	 * This function editEmployee()
	 * @author PhanVM
	 * @description action for view editEmployee
	 */
	public function editEmployee(){
		try {
			$emid = $this->request->query['emid'];
				
			$employeeInfo = $this->User->find("first" , array("conditions"=>array("id"=>$emid)));
			if(empty($employeeInfo)){
				$this->redirect('/employee-list');
				exit();
			}
			if($this->request->is("post")){
				
				$datas 		= array();
				$validate	= true;
				
				$validate = $this->validateForm($this->request->data , array() , $datas , "upload");
				if( $validate && !empty($datas) ){
					if(!empty($_FILES)){
						
						$ext_filename = $datas['username'];
						$is_upload = AppUtility::uploadFile($_FILES,$ext_filename);
						
						if($is_upload)
							$datas['photo'] = $ext_filename;
					}
					
					$datas['id']		= $employeeInfo['User']['id'];
					$datas['password']	= $this->Auth->password('123456');
					
					if($this->saveEmployee($datas)){
						if($this->auth['id'] == $employeeInfo['User']['id'] && $this->auth['group_id'] != $datas['group_id']){
							$this->redirect('/logout');
							exit();
						}else{
							$this->redirect('/view-employee?emid='.$employeeInfo['User']['id']);
							exit();
						}
					}else{
						$this->Session->setFlash("Edit false !. Try again.", 'default' , array('class'=>'callout callout-danger'));
					}
				}
			}
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage(), 'default' , array('class'=>'callout callout-danger'));
		}
		$this->set("employeeInfo" , $employeeInfo);
	}
	
	/**
	 * This function deleteEmployee()
	 * @author PhanVM
	 * @description action delete a employee
	 */
	public function deleteEmployee(){
		
		$emid = $this->request->query['emid'];
		$type = $this->request->query['type'];
		
		$userInfo = $this->User->findById($emid);
		$permision = false;
		if(!empty($userInfo)){
			if((int)$this->auth['group_id'] > (int)$userInfo['User']['group_id']){
				$this->Session->setFlash("You can not delete this employee!", 'default' , array('class'=>'callout callout-danger'));
				$permision = true;
			}else{
				if($this->User->deleteAll(array('User.id' => $emid), false)){
					$this->Session->setFlash("Delete success employee !.", 'default' , array('class'=>'callout callout-success'));
				}else{
					$this->Session->setFlash("Delete false !. Try again.", 'default' , array('class'=>'callout callout-danger'));
				}
			}
		}else{
			$this->Session->setFlash("Delete false !. Try again.", 'default' , array('class'=>'callout callout-danger'));
		}
		if($type == "info" && !empty($userInfo) && $permision)
			$this->redirect('/view-employee?emid='.$emid);
		else 
			$this->redirect('/employee-list');
		exit();
	}
	
	
	/**
	 * This function employeeInfo()
	 * @author PhanVM
	 * @description action for view employeeInfo
	 */
	public function employeeInfo(){
		try {
			$emid = $this->request->query['emid'];
			
			$employeeInfo = $this->User->find("first" , array("conditions"=>array("id"=>$emid)));
			if(empty($employeeInfo)){
				$this->Session->setFlash("This user does not exist!", 'default' , array('class'=>'callout callout-danger'));
				$this->redirect('/employee-list');
				exit();
			}
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage(), 'default' , array('class'=>'callout callout-danger'));
			$this->redirect('/employee-list');
			exit();
		}
		
		$this->set("employeeInfo" , $employeeInfo);
	}
	
	public function changePass(){
		if($this->request->is("post")){
			$post = Sanitize::clean($this->request->data);
			$user = $this->User->findById($this->auth['id']);
			if($user){
				$validate = $this->validateChangePass($post , $user);
				if(!$validate){
					$this->Session->setFlash("An error has occurred. password more than 6 characters", 'default' , array('class'=>'callout callout-danger'));
				}else{
					if($this->User->updateAll(array('User.password'=>"'".$this->Auth->password(trim($post['new_pass']))."'"), array('User.id'=>$this->auth['id']))){
						
						$this->User->updateAll(array('User.change_pass_flag'=>'User.change_pass_flag+1'), array('User.id'=>$this->auth['id']));
						$this->redirect('/logout');
						exit();
					}else{
						$this->Session->setFlash("System error. Please you to try again later", 'default' , array('class'=>'callout callout-danger'));
					}
				}
			}else{
				$this->Session->setFlash("System error. Please you to try again later", 'default' , array('class'=>'callout callout-danger'));
			}
		}
	}
	
	
	protected function validateChangePass( $post , $user){
		$error = 0;
		if(isset($post['old_pass'])){
			if(trim($post['old_pass']) == "" || trim($post['old_pass']) == null){
				$error++;
			}elseif ($this->Auth->password(trim($post['old_pass'])) != $user['User']['password']){
				$error++;
			}
		}else{
			$error++;
		}
		
		if(isset($post['new_pass'])){
			if(strlen(trim($post['new_pass'])) < 6 ){
				$error++;
			}elseif (trim($post['new_pass']) != trim($post['confirm_new_pass'])){
				$error++;
			}
		}
		if($error == 0){
			return true;
		}
		return false;
	}
	
	/**
	 * This function saveEmployee()
	 * @author PhanVM
	 */
	protected function saveEmployee( $datas = array() ){
		$source = $this->User->getDataSource();
		try {
			$source->begin();
			
			if($this->User->saveAll($datas)){
				$source->commit();
				return true;
			}else{ 
				$source->rollback();
			}
		} catch (Exception $e) {
			$source->rollback();
		}
		return false;
	}
	
	/**
	 * This function validateForm()
	 * @author PhanVM
	 * @description function validate data add new employee
	 * @param unknown $request
	 */
	protected function validateForm( $request = array(), $files = array() , &$post , $type = 'insert'){
		
		$post = Sanitize::clean( $request, array('encode'=>false,'escape'=>false) );
		$error = 0;
		
		if( !empty($post) ){
			
			/**** check user name ****/
			if( isset($post['username']) ){
				if( trim($post['username']) == "" || trim($post['username']) == null ){
					$this->Session->setFlash("User name must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					$post['username'] = trim($post['username']);
				}
			}else{
				$this->Session->setFlash("User name must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
			
			/**** check day of brith ****/
			if(isset($post['brithday'])){
				if( trim($post['brithday']) == "" || trim($post['brithday']) == null || !Validation::date(trim($post['brithday'])) ){
					$this->Session->setFlash("Day of brith must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					$post['date_of_brith'] = date("Y-m-d",strtotime($post['brithday']));
					unset($post['brithday']);
				}
			}else{
				$this->Session->setFlash("Day of brith must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
			
			if(isset($post['telephone'])){
				if( trim($post['telephone']) == "" || trim($post['telephone']) == null ){
					$this->Session->setFlash("Telephone must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					$post['telephone'] = $post['telephone'];
				}
			}else{
				$this->Session->setFlash("Telephone must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
			
			if(isset($post['sex'])){
				if( trim($post['sex']) == "" || trim($post['sex']) == null || !Validation::alphaNumeric(trim($post['sex'])) ){
					$this->Session->setFlash("Sex must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					$post['sex'] = (int)$post['sex'];
				}
			}else{
				$this->Session->setFlash("Sex must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
			
			if(isset($post['address'])){
				if( trim($post['address']) == "" || trim($post['address']) == null ){
					$this->Session->setFlash("Address must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					$post['address'] = trim($post['address']);
				}
			}else{
				$this->Session->setFlash("Address must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
			
			
			if(isset($post['email'])){
				if( trim($post['email']) == "" || trim($post['email']) == null ){
					$this->Session->setFlash("Email must not be blank !", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}elseif(!Validation::email(trim($post['email']))){
					$this->Session->setFlash("Wrong email format!", 'default' , array('class'=>'callout callout-danger'));
					$error++;
					return false;
				}else{
					if($type == "insert"){
						$checkEmail = $this->User->findByEmail(trim($post['email']), array('User.email'));
						if(!empty($checkEmail)){
							$this->Session->setFlash("Email already exists!", 'default' , array('class'=>'callout callout-danger'));
							$error++;
							return false;
						}else{
							$post['email'] = trim($post['email']);
						}
					}else{
						$post['email'] = trim($post['email']);
					}
				}
			}else{
				$this->Session->setFlash("Email must not be blank !", 'default' , array('class'=>'callout callout-danger'));
				$error++;
				return false;
			}
		}
		
		/**** validate file upload ****/
		if($type == "insert"){
			if(!empty($files) && isset($files['photo'])){
				if(!AppUtility::validate_image_file($files))
					return false;
			}else{
				return false;
			}
		}
		
		if( $error == 0 ){
			$post['group_id'] = (int) $post['authorization'];
			unset($post['authorization']);
			return true;
		}else{
			$this->Session->setFlash("Please review the information you have entered!", 'default' , array('class'=>'callout callout-danger'));
		}
		return false;
	}
}
