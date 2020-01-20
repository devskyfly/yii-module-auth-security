<?php
namespace devskyfly\yiiModuleAuthSecurity\filters\auth;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;

class IsAdmin extends ActionFilter
{
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $user = Yii::$app->user;

        $url = $request->referrer?:Url::toRoute($user->loginUrl);

        if ($user->isGuest) {
            Yii::$app->getResponse()->redirect($url);
        }

        $manager = Yii::$app->authManager;
        $roles = $manager->getRolesByUser($user->id);
        
        foreach ($roles as $role) {
            if ($role->name == "admin") {
                return true;
            }
        }

        Yii::$app->getResponse()->redirect($url);
    }
}