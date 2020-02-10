<?php
namespace app\console;

use yii\console\Controller;
use devskyfly\yiiModuleAuthSecurity\components\UserManager;
use yii\console\ExitCode;

class UsersController extends Controller
{
    public function actionCreate()
    {
        
        try {
            $user_cls = UserManager::getIdentityCls();
            $user = new $user_cls();
            $user->username = "user1";
            UserManager::add($user, "password", 
            [
                "UserInfo"=>
                ["name"=>"Log.1.2"]
            ]);
        } catch (\Exception $e) {
            throw $e;
        } 

        return ExitCode::OK;
    }
}