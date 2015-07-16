<?php
/**
 * This class check redrect 403 when check error ACL
 * @author PhanVM
 * @date 2014/11/03
 */
App::import('Component', 'Auth');

class AppServerAuthComponent extends AuthComponent {
	public $accessDeniedUrl = null;
	/**
	 * Main execution method.  Handles redirecting of invalid users, and processing
	 * of login form data.
     * @author vunn
	 *
	 * @param Controller $controller A reference to the instantiating controller object
	 * @return boolean
	 */
	public function startup(Controller $controller) {
		if ($controller->name == 'CakeError') {
			return true;
		}
		$methods = array_flip(array_map('strtolower', $controller->methods));
		$action = strtolower($controller->request->params['action']);

		$isMissingAction = (
				$controller->scaffold === false &&
				!isset($methods[$action])
		);

		if ($isMissingAction) {
			return true;
		}

		if (!$this->_setDefaults()) {
			return false;
		}
		$request = $controller->request;

		$url = '';

		if (isset($request->url)) {
			$url = $request->url;
		}
		$url = Router::normalize($url);
		$loginAction = Router::normalize($this->loginAction);
		/**
		 * @author PhanVM
		 * ************************
		 * Check list allow define
		 */
		$listActionAllowDefine = $this->getActionAllow();
		$controllerCurrent = strtolower($controller->request->params['controller']);
		$checkAllowDefine = false;
		if(isset($listActionAllowDefine[$controllerCurrent])){
			$listActionAllowCurrent = $listActionAllowDefine[$controllerCurrent];
			$checkAllowDefine = (
					$listActionAllowCurrent == array('*') ||
					in_array($action, array_map('strtolower', $listActionAllowCurrent))
			);
		}
		//end
		if(!$checkAllowDefine){ // edit new
			$allowedActions = $this->allowedActions;
			$isAllowed = (
					$this->allowedActions == array('*') ||
					in_array($action, array_map('strtolower', $allowedActions))
			);
		}else{ // edit new
			$isAllowed = true;
		}
		if ($loginAction != $url && $isAllowed) {
			return true;
		}

		if ($loginAction == $url) {
			if (empty($request->data)) {
				if (!$this->Session->check('Auth.redirect') && !$this->loginRedirect && env('HTTP_REFERER')) {
					$this->Session->write('Auth.redirect', $controller->referer(null, true));
				}
			}
			return true;
		} else {
			if (!$this->_getUser()) {
				if (!$request->is('ajax')) {
					$this->flash($this->authError);
					$this->Session->write('Auth.redirect', $request->here());
					$controller->redirect($loginAction);
					return false;
				} elseif (!empty($this->ajaxLogin)) {
					$controller->viewPath = 'Elements';
					echo $controller->render($this->ajaxLogin, $this->RequestHandler->ajaxLayout);
					$this->_stop();
					return false;
				} else {
					$controller->redirect($this->accessDeniedUrl, 403);
				}
			}
		}
		if (empty($this->authorize) || $this->isAuthorized($this->user())) {
			return true;
		}elseif($this->isAuthorized($this->user()) === false){
			$controller->redirect($this->accessDeniedUrl,403);
		}
		$this->flash($this->authError);
		$default = '/';
		if (!empty($this->loginRedirect)) {
			$default = $this->loginRedirect;
		}
		$controller->redirect($controller->referer($default), null, true);
		return false;
	}
	/**
	 * Function get action allow
     * @author vunn
	 */
	function getActionAllow(){
		App::uses('PermissionConfig', 'Config');
		return PermissionConfig::$unloginConfig;
	}
}
?>