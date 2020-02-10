<?php 
namespace app\models\user;

use devskyfly\yiiModuleAuthSecurity\models\auth\User;

class CustomUser extends User
{
    public function extensions()
    {
        return [
            "UserInfo" => UserInfo::class
        ];
    }

    public static function table()
    {
        return "user";
    }
}