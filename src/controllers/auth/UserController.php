<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers\auth;

use devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController;
use devskyfly\yiiModuleAuthSecurity\models\auth\UserFilter;
use devskyfly\yiiModuleAuthSecurity\Module;
use Yii;

class UserController extends AbstractContentPanelController
{
        
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::sectionItem()
     */
    public static function sectionCls()
    {
        //Если иерархичность не требуется, товместо названия класса можно передать null
        return null;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::entityItem()
     */
    public static function entityCls()
    {
        return Yii::$app->user->identityClass;
    }
    
    public static function entityFilterCls()
    {
        return UserFilter::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::entityEditorViews()
     */
    public function entityEditorViews()
    {
        return function($form, $item)
        {
            $module = Module::getInstance();
            $optViewClb = $module->optEntityViewClb;
            return [
                [
                    "label" => "main",
                    "content" =>
                    $form->field($item, 'username')
                    .$form->field($item, 'created_at')
                    .$form->field($item, 'updated_at')->checkbox(['value'=>'Y', 'uncheckValue'=>'N', 'checked' => $item->active == 'Y'?true:false])
                    .$optViewClb($form, $item)
                ],
            ];
        };
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::sectionEditorItems()
     */
    public function sectionEditorViews()
    {
        return null;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::entityCustomColumns()
     */
    public function entityCustomColumns()
    {
        return ['username'];
    }

    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::itemLabel()
     */
    public function itemLabel()
    {
        return "Список пользователей";
    }
}
?>