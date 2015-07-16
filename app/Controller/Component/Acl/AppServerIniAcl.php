<?php
/**
 * Class check Permission by group id
 * @author vunn
 * @date 15/10/2012
 */
 App::uses('IniAcl', 'Controller/Component/Acl');
class AppServerIniAcl extends IniAcl{
    public $userPath = 'User.group_id';
    public function initialize(Component $component) {
        parent::initialize($component);
        App::uses('PermissionConfig', 'Config');
        $this->config = PermissionConfig::$actionAllowConfig;
	}
    
 }
?>