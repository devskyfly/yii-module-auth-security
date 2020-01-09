<?php
namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['admin-page', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
}