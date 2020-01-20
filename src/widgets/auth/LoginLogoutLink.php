<?php
namespace devskyfly\yiiModuleAuthSecurity\widgets\auth;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class LoginLogoutLink extends Widget
{   
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $url = Yii::$app->user->loginUrl;
        $loginUrl = Url::toRoute($url);
        $logoutUrl = Url::toRoute(['/site/logout']);
        return $this->render('login-logout-link', compact("loginUrl", "logoutUrl"));
    }
}

