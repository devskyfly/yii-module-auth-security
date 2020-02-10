<?php 
namespace app\models\user;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItemExtension;
use yii\helpers\ArrayHelper;

class UserInfo extends AbstractItemExtension
{
    protected static function itemCls()
    {
        return CustomUser::class;
    }

    public function rules()
    {
        $rules = parent::rules();
        $new = [
            [["name"], "string"]
        ];
        
        return ArrayHelper::merge($rules, $new);
    }
}