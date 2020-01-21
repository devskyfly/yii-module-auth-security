<?php
namespace devskyfly\yiiModuleAuthSecurity\controllers\security;

use devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController;
use devskyfly\yiiModuleAuthSecurity\models\security\IpBlacklist;
use devskyfly\yiiModuleAuthSecurity\models\security\IpBlacklistFilter;

class IpBlacklistController extends AbstractContentPanelController
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
        return IpBlacklist::class;
    }
    
    public static function entityFilterCls()
    {
        return IpBlacklistFilter::class;
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
                    $form->field($item,'ip')
                    .$form->field($item,'create_date_time')
                    .$form->field($item,'change_date_time')
                    .$form->field($item,'active')
                    ->checkbox(['value'=>'Y', 'uncheckValue'=>'N', 'checked'=>$item->active=='Y'?true:false])
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
        return ['ip'];
    }

    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\AbstractContentPanelController::itemLabel()
     */
    public function itemLabel()
    {
        return "Черный список Ip адресов";
    }
}
?>