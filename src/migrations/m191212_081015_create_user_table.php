<?php

use devskyfly\yiiModuleAuthSecurity\migrations\helpers\UserMigrationHelper;
use devskyfly\yiiModuleAuthSecurity\Module;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m191212_081015_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $userHelper = new UserMigrationHelper();
        $this->createTable(Module::tablesPrefix().'_user', $userHelper->getFieldsDefinition());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Module::tablesPrefix().'_user');
    }
}
