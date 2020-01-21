<?php
namespace devskyfly\yiiModuleAuthSecurity\models\security;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractUnnamedEntity;
use devskyfly\yiiModuleAuthSecurity\Module;

/**
 * 
 * @author devskyfly
 * @property integer $id
 * @property string $ip
 * @property string $code
 * @property string $active
 * @property integer $sort
 * @property string $create_date_time
 * @property string $change_date_time
 * @property string $_section__id
 */
class IpBlacklist extends AbstractUnnamedEntity
{
    protected static function sectionCls()
    {
        return null;
    }

    public function extensions()
    {
        return [];
    }

    public function getIp()
    {
        return $this->ip;
    }
    
    public function setIp($val)
    {
        $this->name = $val;
        return $this;
    }
    
    /**
     *
     * @param string $ip
     * @return \yii\db\ActiveRecord|array|NULL
     */
    public static function findByIp($ip)
    {
        return static::find()->where(['ip' => $ip])->one();
    }
    
    /**********************************************************************/
    /** Redeclaration **/
    /**********************************************************************/
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['ip','ip'];
        return $rules;
    }

    public static function tableName()
    {
        return Module::tablesPrefix().'_ip_blacklist';
    }
}

