<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181222_205253_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*$this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
        ]);
*/
        //$this->addForeignKey("user_id", "users", "id", "tasks", "responsible_id");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropTable('users');
    }
}
