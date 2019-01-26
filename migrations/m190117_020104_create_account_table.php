<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `account`.
 */
class m190117_020104_create_account_table extends Migration
{
    const TABLE_NAME = '{{%account}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'balance' => ' NUMERIC (15,2) DEFAULT NULL',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
