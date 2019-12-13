<?php

use devskyfly\yiiModuleAuthSecurity\migrations\helpers\UserMigrationHelper;
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
        $this->createTable('auth_security_user', $userHelper->getFieldsDefinition());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth_security_user');
    }
}
