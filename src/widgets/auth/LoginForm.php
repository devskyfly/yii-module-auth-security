<?php
namespace devskyfly\yiiModuleAuthSecurity\widgets\auth;

use yii\base\Widget;
use devskyfly\yiiModuleAuthSecurity\models\auth\LoginForm as LoginFormModel;
use devskyfly\php56\types\Obj;

class LoginForm extends Widget
{
    /**
     * 
     * @var LoginForm
     */
    public $loginForm = null;
    
    public function init()
    {
        parent::init();
        if (!Obj::isA($this->loginForm, LoginFormModel::class)) {
            throw new \InvalidArgumentException('Property $loginForm is not '.LoginFormModel::class.' type.'); 
        }
    }
    
    public function run()
    {
        $loginForm = $this->loginForm;
        return $this->render('login-form', compact("loginForm"));
    }
}

