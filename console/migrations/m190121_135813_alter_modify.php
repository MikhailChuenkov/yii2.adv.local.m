<?php

use yii\db\Migration;

/**
 * Class m190121_135813_alter_modify
 */
class m190121_135813_alter_modify extends Migration
{
    protected $tableName = 'tasks';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->tableName, 'date', 'date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->tableName, 'date', 'datetime');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190121_135813_alter_modify cannot be reverted.\n";

        return false;
    }
    */
}
