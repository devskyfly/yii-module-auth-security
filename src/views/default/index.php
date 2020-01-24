<?php
/* $this yii/web/view */
/* $module [] */
use devskyfly\yiiModule\widgets\NavigationMenu;
?>

<?
$this->title = $module->title();
?>

<div class="row">
    <div class="col-xs-3">
        <?=NavigationMenu::widget(['info' => $module->getNavigationInfo(), "routePrefix" => $module->getRoute()])?>
    </div>
    <div class="col-xs-9">
    	
    </div>
</div>