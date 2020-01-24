<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers;

use yii\web\Controller;
use devskyfly\yiiModuleAuthSecurity\Module;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $module = (Module::getInstance());
        return $this->render('index', compact("module"));
    }
}