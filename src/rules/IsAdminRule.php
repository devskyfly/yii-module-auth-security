<?php
namespace devskyfly\yiiModuleAuthSecurity\rules;

use Yii;
use yii\rbac\Rule;

class IsAdminRule extends Rule
{
    public $name = "isAdmin";

    protected $roleName = "admin";

    public function execute($user, $item, $params)
    {
       /* if (!$user) {
            return false;
        }

        $manager = Yii::$app->authManager;
        $roles = $manager->getRolesByUser($user->id);
        
        foreach ($roles as $role) {
            if ($role->name == "admin") {
                return true;
            }
        }*/

        return false;
    }
}