<?php
namespace app\controllers;

use devskyfly\yiiModuleAuthSecurity\actions\LoginAction;
use devskyfly\yiiModuleAuthSecurity\actions\LogoutAction;
use devskyfly\yiiModuleAuthSecurity\components\UserManager;
use devskyfly\yiiModuleAuthSecurity\filters\auth\IsAdmin;
use devskyfly\yiiModuleAuthSecurity\filters\auth\IsAuth;
use devskyfly\yiiModuleAuthSecurity\models\auth\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'isAdmin' => [
                'class' => IsAdmin::class,
                'only' => ['admin-page'],          
            ],
            'isAuth' => [
                'class' => IsAuth::class,
                'only' => ['auth-page'],          
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'login' => [
                'class' => LoginAction::class
            ],
            'logout' => [
                'class' => LogoutAction::class
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = "Index";

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'index description'
        ]);

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'index keywords'
        ]);
        
        return $this->render("index");
    }

    public function actionAdminPage()
    {
        $this->view->title = "Admin page";

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'admin page description'
        ]);

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'admin page keywords'
        ]);
        
        return $this->render("admin-page");
    }

    public function actionUserPage()
    {
        $this->view->title = "User page";

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'user page description'
        ]);

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'user page keywords'
        ]);
        
        return $this->render("user-page");
    }

    public function actionAuthPage()
    {
        $this->view->title = "Auth page";

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'auth page description'
        ]);

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'auth page keywords'
        ]);
        
        return $this->render("auth-page");
    }
}