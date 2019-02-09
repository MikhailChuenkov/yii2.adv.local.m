<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181222_183647_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'description' => $this->text(),
            'responsible_id' => $this->integer()
        ]);

        $this->createIndex("id_task_responsible", "tasks", "responsible_id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
