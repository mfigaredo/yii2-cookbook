<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `table_contest_and_prize`.
 */
class m190125_221332_create_table_contest_and_prize_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%contest}}', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%prize}}', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING,
            'amount' => Schema::TYPE_INTEGER,
        ], $tableOptions );

        $this->createTable('{{%contest_prize_assn}}',[
            'contest_id' => Schema::TYPE_INTEGER,
            'prize_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk_contest_prize_assn_contest_id', '{{%contest_prize_assn}}', 'contest_id','{{%contest}}','id');
        $this->addForeignKey('fk_contest_prize_assn_prize_id', '{{%contest_prize_assn}}', 'prize_id', '{{%prize}}', 'id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_contest_prize_assn_contest_id','{{%contest_prize_assn}}');
        $this->dropForeignKey('fk_contest_prize_assn_prize_id','{{%contest_prize_assn}}');
        $this->dropTable('{{%contest_prize_assn}}');
        $this->dropTable('{{%prize}}');
        $this->dropTable('{{%contest}}');

    }
}
