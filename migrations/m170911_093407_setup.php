<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m170911_093407_setup
 */
class m170911_093407_setup extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'first_name' => $this->text()->notNull(),
            'last_name' => $this->text()->notNull(),
            'email' => $this->text()->notNull(),
            'personal_code' => $this->bigInteger()->notNull(),
            'phone' => $this->bigInteger()->notNull(),
            'active' => $this->boolean(),
            'dead' => $this->boolean(),
            'lang' => $this->text()
        ]);

        $this->createTable('loan', [
            'id' => $this->primaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'interest' => $this->decimal(10, 2)->notNull(),
            'duration' => $this->integer()->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
            'campaign' => $this->integer()->notNull(),
            'status' => $this->boolean()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user');
        $this->dropTable('loan');
    }
}
