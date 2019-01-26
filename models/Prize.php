<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prize".
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 *
 * @property ContestPrizeAssn[] $contestPrizeAssns
 */
class Prize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prize';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['amount'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            // 'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestPrizeAssns()
    {
        return $this->hasMany(ContestPrizeAssn::className(), ['prize_id' => 'id']);
    }

    public function getContests() 
    {
        return $this->hasMany(Contest::className(), ['id' => 'contest_id'])->viaTable('contest_prize_assn', ['prize_id' => 'id']);
    }    
}
