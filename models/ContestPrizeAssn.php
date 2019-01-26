<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contest_prize_assn".
 *
 * @property int $contest_id
 * @property int $prize_id
 *
 * @property Contest $contest
 * @property Prize $prize
 */
class ContestPrizeAssn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contest_prize_assn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contest_id', 'prize_id', 'amount'], 'integer'],
            [['contest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contest::className(), 'targetAttribute' => ['contest_id' => 'id']],
            [['prize_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prize::className(), 'targetAttribute' => ['prize_id' => 'id']],
            // [['amount'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contest_id' => 'Contest ID',
            'prize_id' => 'Prize ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContest()
    {
        return $this->hasOne(Contest::className(), ['id' => 'contest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrize()
    {
        return $this->hasOne(Prize::className(), ['id' => 'prize_id']);
    }
}
