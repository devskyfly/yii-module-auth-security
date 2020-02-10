<?php

return [
    'class' => 'yii\web\User',
    //'identityClass' => 'devskyfly\yiiModuleAuthSecurity\models\auth\User',
    'identityClass' => 'app\models\user\CustomUser',
    'loginUrl' => ['/site/login']
];