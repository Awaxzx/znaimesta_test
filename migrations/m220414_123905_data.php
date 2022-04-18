<?php

use yii\db\Migration;

/**
 * Class m220414_123905_data
 */
class m220414_123905_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%rooms}}',
            ['name', 'quota', 'created_at'],
            [
                ['name' => 'Одноместный', 'quota' => '2', 'created_at' => time(),],
                ['name' => 'Двухместный', 'quota' => '4', 'created_at' => time(),],
                ['name' => 'Люкс', 'quota' => '3', 'created_at' => time(),],
                ['name' => 'Де-Люкс', 'quota' => '5', 'created_at' => time(),],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%rooms}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220414_123905_data cannot be reverted.\n";

        return false;
    }
    */
}
