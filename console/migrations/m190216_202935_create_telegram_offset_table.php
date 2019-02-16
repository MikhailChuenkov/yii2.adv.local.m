<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_offset}}`.
 */
class m190216_202935_create_telegram_offset_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_offset}}', [
            'id' => $this->integer(),
            'telegram_offset' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_offset}}');
    }
}
