<?php

use devskyfly\yiiModuleAdminPanel\assets\AdminPanelAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */
?>
<?
AdminPanelAsset::register($this);
?>
<?php $this->beginPage() ?>
<html>
<head>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<body>
<div class="container">
    <header>
        <?=$this->render('_header');?>
    </header>
    <?php $this->beginBody() ?>
        
        <?= $content ?>
        
    <?php $this->endBody() ?>
    </body>
</div>
</html>
<?php $this->endPage() ?>