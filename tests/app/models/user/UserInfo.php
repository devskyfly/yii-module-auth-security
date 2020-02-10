<?php 
namespace app\models\user;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItemExtension;

class UserInfo extends AbstractItemExtension
{
    protected static function itemCls()
    {
        return CustomUser::class;
    }
}