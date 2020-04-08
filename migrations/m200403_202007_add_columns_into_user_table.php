<?php

use yii\db\Migration;

/**
 * Class m200403_202007_add_columns_into_user_table
 */
class m200403_202007_add_columns_into_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200403_202007_add_columns_into_user_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('user', 'authKey', $this->string(200));
        $this->addColumn('user', 'accessToken', $this->string(200));
    }

    public function down()
    {
        //echo "m200403_202007_add_columns_into_user_table cannot be reverted.\n";
        $this->dropColumn('user', 'authKey');
        $this->dropColumn('user', 'accessToken');
    }

}
