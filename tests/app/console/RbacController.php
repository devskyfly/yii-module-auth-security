<?php
namespace app\console;

use yii\console\Controller;
use yii\console\ExitCode;

class RbacController extends Controller
{
    public function actionIndex()
    {
        try {
            $authManager = Yii::$app->authManager;

            $authManager->createRole();
        } catch (\Exception $e) {

        } 

        return ExitCode::OK;
    }
}