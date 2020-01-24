<?php
use devskyfly\yiiModuleAuthSecurity\Module;
use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\EntityMigrationHelper;

/**
 * Handles the creation of table `{{%ip_blacklist}}`.
 */
class m200120_095818_create_ip_blacklist_table extends EntityMigrationHelper
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $prefix = Module::tablesPrefix();
        $this->createTable($prefix.'_ip_blacklist', $this->getFieldsDefinition());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $prefix = Module::tablesPrefix();
        $this->dropTable($prefix.'_ip_blacklist');
    }
    
    public function getFieldsDefinition()
    {
        return [
            'id'=>$this->primaryKey(11),
            'ip'=>$this->string(255)->notNull()->unique(),
            //'code'=>$this->string(255)->unique(),
            'active'=>"ENUM('Y','N') NOT NULL",
            'sort'=>$this->integer(11),
            'create_date_time'=>$this->dateTime(),
            'change_date_time'=>$this->dateTime(),
            '_section__id'=>$this->integer(11)
        ];
    }
}
