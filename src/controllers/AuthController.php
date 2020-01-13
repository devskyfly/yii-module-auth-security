<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers;

use Yii;
use yii\web\Controller;
use devskyfly\yiiModuleAuthSecurity\models\auth\LoginForm;
use devskyfly\yiiModuleAuthSecurity\Module;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $module = Module::getInstance();

        $title = $module->loginTitle;
        $keywords = $module->loginKeywords;
        $description = $module->loginDescription;

        $view = $this->view;
        $view->title = $title;
        $view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $view->registerMetaTag(['name' => 'description', 'content' => $description]);

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                /*'title' => $title,
                'keywords' => $keywords,
                'description' => $description*/
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}