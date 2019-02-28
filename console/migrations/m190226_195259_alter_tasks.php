<?php

use yii\db\Migration;

/**
 * Class m190226_195259_alter_tasks
 */
class m190226_195259_alter_tasks extends Migration
{
    protected $tableName = 'tasks';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'date_end', $this->date());
        $this->addColumn($this->tableName, 'project_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'date_end');
        $this->dropColumn($this->tableName, 'project_id');
    }

}
