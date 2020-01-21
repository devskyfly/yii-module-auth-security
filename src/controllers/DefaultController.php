<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers;

use yii\web\Controller;
use devskyfly\yiiModuleAuthSecurity\Module;
use devskyfly\yiiModuleAuthSecurity\ModuleNavigation;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $title = Module::TITLE;
        $module_navigation = new ModuleNavigation();
        $list = [$module_navigation->getData()];
        return $this->render('index', compact("list", "title"));
    }
}