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
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->controller->goBack();
        } else {
            $model->password = '';

            return $this->controller->render('login', [
                'model' => $model,
            ]);
        }
    }
}