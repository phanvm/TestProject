<?php
App::uses('FormAuthenticate', 'Controller/Component/Auth');
App::uses('Sanitize', 'Utility');
/**
 * An authentication adapter for AuthComponent.  Provides the ability to authenticate using POST
 * data.  Can be used by configuring AuthComponent to use it via the AuthComponent::$authenticate setting.
 *
 *
 * When configuring FormAuthenticate you can pass in settings to which fields, model and additional conditions
 * are used. See FormAuthenticate::$settings for more information.
 *
 * @author PhanVm
 * @date 2014/11/03
 */
class AppServerAuthenticate extends FormAuthenticate {

	public $settings = array(		
		'types'  => array(
					'Admin'=>array(
							'fields' => array(
									'email' 	=> 'email',
									'password'  => 'password'
							),
							'userModel' => 'User',
							'scope' => array('delete_flag' => 0 , 'group_id' => 1),
							'recursive' => 0,
					),
					'User'=>array(
						'fields' => array(
								'email' 	=> 'email',
								'password'  => 'password'
						),
						'userModel' => 'User',
						'scope' => array('delete_flag' => 0),
						'recursive' => 0,
				)
			),
			
			'fields' => array(
					'email' => 'email',
					'password' => 'password'
			),
			'userModel' => 'User',
			'scope' => array('delete_flag' => 0),
			'recursive' => 0
	);
	
/**
 * Authenticates the identity contained in a request.  Will use the `settings.userModel`, and `settings.fields`
 * to find POST data that is used to find a matching record in the `settings.userModel`.  Will return false if
 * there is no post data, either username or password is missing, of if the scope conditions have not been met.
 *
 * @author PhanVM
 * @date 2014/11/03
 * 
 * @param CakeRequest $request The request that contains login information.
 * @param CakeResponse $response Unused response object.
 * @return mixed.  False on login failure.  An array of User data on success.
 */
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		if(isset($request->data['type'])){
			$type = $request->data['type'];
			if( ! isset($this->settings['types'][$type]) ) throw new Exception(__('Type %s login not setting',$type));
			
			$types = $this->settings['types'];
			$this->settings = array_merge(array('types'=>$types),$types[$type]);
		}
		
		$fields = $this->settings['fields'];
		$model = $this->settings['userModel'];
		$userName =  Sanitize::paranoid($request->data[$model][$fields['email']]);
		$password =  Sanitize::paranoid($request->data[$model][$fields['password']]);
		//End
		if (empty($request->data[$model])) {
			$request->data[$model] = array(
					$fields['email'] => isset($userName)? $userName : null,
					$fields['password'] => isset($password)? $password : null
			);
		}
		$user = parent::authenticate($request, $response);  
		if(!$user)
		{
			$user = $this->_processAuth($request, $response);
		}
		if(! empty($user) && is_array($user) && ! isset($user['group_id']) && isset($this->settings['groupId'])) {
			$user['group_id'] = $this->settings['groupId'];
		}
		return $user;
	}
	
	protected function _processAuth(CakeRequest $request, CakeResponse $response)
	{
		$userModel = $this->settings['userModel'];
		list($plugin, $model) = pluginSplit($userModel);
		
		$fields = $this->settings['fields'];
		if (empty($request->data[$model])) {
			return false;
		}
		if (
			empty($request->data[$model][$fields['email']]) ||
			empty($request->data[$model][$fields['password']])
		) {
			return false;
		}
		return $this->_findUser(
			$request->data[$model][$fields['email']],
			$request->data[$model][$fields['password']]
		);
	}

	protected function _findUserWithNewPassword($username, $password) {
		try {
			$userModel = $this->settings['userModel'];
			list($plugin, $model) = pluginSplit($userModel);
			$fields = $this->settings['fields'];
			
			$conditions = array(
					$model . '.' . $fields['email'] => $username,
					$model . '.' . $fields['password'] => $this->_newPassword($password),
			);
			if (!empty($this->settings['scope'])) {
				$conditions = array_merge($conditions, $this->settings['scope']);
			}
			$result = ClassRegistry::init($userModel)->find('first', array(
					'conditions' => $conditions,
					'recursive' => (int)$this->settings['recursive']
			));
			debug($result);
			if (empty($result) || empty($result[$model])) {
				return false;
			}
		} catch (Exception $e) {
		}
		
		unset($result[$model][$fields['password']]);
		return $result[$model];
	}
	
	protected function _newPassword($password)
	{
		return AppUtility::tripleDesEncrypt(AppConst::KEY_256_ENCRYPT_PASSWORD, $password);
	}

}
