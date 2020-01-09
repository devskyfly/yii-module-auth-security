<?php
namespace devskyfly\yiiModuleAuthSecurity;

use Yii;


class Module extends \yii\base\Module
{   

    const CSS_NAMESPACE = 'devskyfly-yii-module-auth-security';

    public function init()
    {
        parent::init();
        Yii::setAlias("@devskyfly/yiiModuleAuthSecurity", __DIR__);
        
        /**
         * Define controller namespace for console application.
         */
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'devskyfly\yiiModuleAuthSecurity\console';
        } 
    }
    
}