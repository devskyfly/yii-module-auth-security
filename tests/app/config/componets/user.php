<?php

return [
    'class' => 'yii\web\User',
    'identityClass' => 'devskyfly\yiiModuleAuthSecurity\models\auth\User',
    'loginUrl' => ['/?r=auth-security/auth/login']
];