<?php
namespace devskyfly\yiiModuleAuthSecurity\actions;

use Yii;
use yii\base\Action;
use devskyfly\yiiModuleAuthSecurity\models\auth\LoginForm;
use devskyfly\yiiModuleAuthSecurity\Module;

class LoginAction extends Action
{
    public $view;

    public function run()
    {
        $module = Module::getInstance();

        $title = $module->loginTitle;
        $keywords = $module->loginKeywords;
        $description = $module->loginDescription;

        $view = $this->controller->view;
        $view->title = $title;
        $view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $view->registerMetaTag(['name' => 'description', 'content' => $description]);

        if (!Yii::$app->user->isGuest) {
            return $this->controller->goHome();
        }

        $loginForm = new LoginForm();
        
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->controller->goBack();
        } else {
            $loginForm->password = '';

            return $this->controller->render('login', [
                'loginForm' => $loginForm,
            ]);
        }
    }
}