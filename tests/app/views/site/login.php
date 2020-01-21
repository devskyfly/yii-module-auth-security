<?php
/* @var $this yii\web\View */
/* @var $loginForm app\models\LoginForm */


use devskyfly\yiiModuleAuthSecurity\widgets\auth\LoginForm;
?>

<?=LoginForm::widget(compact("loginForm"));?>
