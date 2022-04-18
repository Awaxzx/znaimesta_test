<?php

use yii\db\Migration;

/**
 * Class m220413_163708_booking
 */
class m220413_163708_booking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rooms}}', [
            'id'         => $this->primaryKey(),
            'name'       => $this->string(255),
            'quota'      => $this->smallInteger(3)->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createTable('{{%booking}}', [
            'id'         => $this->primaryKey(),
            'room_id'    => $this->integer(11)->notNull(),
            'name'       => $this->string(255),
            'email'      => $this->string(255),
            'date_from'  => $this->date(),
            'date_to'    => $this->date(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addForeignKey('fk_booking_room_id', '{{%booking}}', 'room_id', '{{%rooms}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_booking_room_id', '{{%booking}}');
        $this->dropTable('{{%booking}}');
        $this->dropTable('{{%rooms}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220413_163708_booking cannot be reverted.\n";

        return false;
    }
    */
}
