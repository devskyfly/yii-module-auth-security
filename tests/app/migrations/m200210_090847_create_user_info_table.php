<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\ExtensionMigrationHelper;

/**
 * Handles the creation of table `{{%user_info}}`.
 */
class m200210_090847_create_user_info_table extends ExtensionMigrationHelper
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fields = $this->getFieldsDefinition();
        $fields["name"] = $this->string(256)->notNull();
        $this->createTable('{{%user_info}}', $fields);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_info}}');
    }
}
