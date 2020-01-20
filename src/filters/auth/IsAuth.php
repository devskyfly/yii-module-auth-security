<?php
namespace devskyfly\yiiModuleAuthSecurity\filters\auth;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;

class IsAuth extends ActionFilter
{
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $user = Yii::$app->user;

        $url = $request->referrer?:Url::toRoute($user->loginUrl);

        if ($user->isGuest) {
            Yii::$app->getResponse()->redirect($url);
        } 

        return true;
    }
}