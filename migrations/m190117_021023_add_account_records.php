<?php

use yii\db\Migration;
use app\models\Account;
/**
 * Class m190117_021023_add_account_records
 */
class m190117_021023_add_account_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $accountFirst = new Account();
        $accountFirst->balance = 1110;
        $accountFirst->save();

        $accountSecond = new Account();
        $accountSecond->balance = 779;
        $accountSecond->save();

        $accountThird = new Account();
        $accountThird->balance = 568;
        $accountThird->save();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m190117_021023_add_account_records cannot be reverted.\n";
        $this->truncateTable('{{%account}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190117_021023_add_account_records cannot be reverted.\n";

        return false;
    }
    */
}
