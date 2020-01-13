<?php
use yii\helpers\Html;        
?>

<?if(Yii::$app->user->isGuest):?>
	<?=Html::a('Login', $loginUrl)?>
<?else:?>
	<?=Html::beginForm($logoutUrl, 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
            )
        . Html::endForm()
	?>
<?endif;?>