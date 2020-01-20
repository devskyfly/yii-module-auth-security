<?php
namespace devskyfly\yiiModuleAuthSecurity\rules;

use Yii;
use yii\rbac\Rule;

class IsUserRule extends Rule
{
    public $name = "isUser";

    protected $roleName = "user";

    public function execute($user, $item, $params)
    {
        if (!$user) {
            return false;
        }

        $manager = Yii::$app->authManager;
        $roles = $manager->getRolesByUser($user->id);
        
        foreach ($roles as $role) {
            if ($role->name == "user") {
                return true;
            }
        }

        return false;
    }
}