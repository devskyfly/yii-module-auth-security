<?php
namespace devskyfly\yiiModuleAuthSecurity;

use devskyfly\php56\types\Vrbl;
use devskyfly\yiiModule\AbstractModule;

class Module extends AbstractModule
{   

    public $loginTitle = "Login page";
    public $loginKeywords = "Login keywords";
    public $loginDescription = "Login description";

    /**
     * $form:yii\widgets\ActiveForm, $item:AbstractItem
     */
    public $optEntityViewClb = null;

    public function init()
    {
        parent::init();

        if (Vrbl::isNull($this->optEntityViewClb)) {
            $this->optEntityViewClb = function($form, $item) {
                return "";
            };
        }
    }

    public function initNavigationInfo()
    {
        $this->navigationInfo = [
            [
                "label" => "",
                "sub_list" => [
                    [
                        "name" => "Пользователи",
                        "route" => "auth/user"
                    ],
                    [
                        "name" => "Черный список Id",
                        "route" => "security/ip-blacklist"
                    ]
                ]
            ]
        ];
    } 
    /**
     *
     * @return string
     */
    public static function title()
    {
        return "Аутентификация и безопасность";
    }

    /**
     *
     * @return string
     */
    public static function cssNamespace()
    {
        return 'devskyfly-yii-module-auth-security';
    }
    
    public static function dir()
    {
        return __DIR__;
    }

    public static function vendor()
    {
        return 'devskyfly';
    }

    public static function package()
    {
        return "yii-module-auth-security";
    }

    public static function tablesPrefix()
    {
        return "auth_security";
    }

    public static function getRoute()
    {
        return "/".(Module::getInstance())->id;
    }


}