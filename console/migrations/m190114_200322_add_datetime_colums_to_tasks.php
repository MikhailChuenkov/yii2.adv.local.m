<?php

use yii\db\Migration;

/**
 * Class m190114_200322_add_datetime_colums_to_tasks
 */
class m190114_200322_add_datetime_colums_to_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tasks", "created_at", $this->dateTime());
        $this->addColumn("tasks", "updated_at", $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("tasks", "created_at");
        $this->dropColumn("tasks", "updated_at");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190114_200322_add_datetime_colums_to_tasks cannot be reverted.\n";

        return false;
    }
    */
}
