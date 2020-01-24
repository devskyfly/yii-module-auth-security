<?php

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
        $this->createTable(Module::tablesPrefix().'_user', $this->getFieldsDefinition());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Module::tablesPrefix().'_user');
    }

    public function getFieldsDefinition()
    {
        return [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            
            'code'=>$this->string(255)->unique(),
            'active'=>"ENUM('Y','N') NOT NULL",
            'sort'=>$this->integer(11),
            'create_date_time'=>$this->dateTime(),
            'change_date_time'=>$this->dateTime(),
            '_section__id'=>$this->integer(11)
        ];
    }
}
