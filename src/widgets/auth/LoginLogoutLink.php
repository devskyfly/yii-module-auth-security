<?php
namespace devskyfly\yiiModuleAuthSecurity\widgets\auth;

use yii\base\Widget;
use devskyfly\yiiModuleAuthSecurity\Module;
use yii\helpers\Url;

class LoginLogoutLink extends Widget
{   
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $module = Module::getInstance();
        $moduleId = $module->id;
        $loginUrl = Url::toRoute(['/'.$moduleId.'/auth/login']);
        $logoutUrl = Url::toRoute(['/'.$moduleId.'/auth/logout']);
        return $this->render('login-logout-link', compact("loginUrl", "logoutUrl"));
    }
}

