<?php
return [
    "class" => "devskyfly\yiiModuleAuthSecurity\Module",
    "optEntityViewClb" => function($form, $item) {
        return $form->field($item->extensions['UserInfo'], 'name');
    }
] ;