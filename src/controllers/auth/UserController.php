<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers\auth;

use devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController;
use devskyfly\yiiModuleAuthSecurity\models\auth\User;
use devskyfly\yiiModuleAuthSecurity\models\auth\UserFilter;

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
        return User::class;
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
            return [
                [
                    "label"=>"main",
                    "content"=>
                    $form->field($item, 'username')
                    .$form->field($item, 'created_at')
                    .$form->field($item, 'updated_at')
                    ->checkbox(['value'=>'Y', 'uncheckValue'=>'N', 'checked' => $item->active == 'Y'?true:false])
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