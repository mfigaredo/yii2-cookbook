<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Car]].
 *
 * @see Car
 */
class CarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /** @var */
    public $type;

    /**
     * @param \yii\db\QueryBuilder $builder
     * @return \yii\db\Query
     */
    public function prepare($builder)
    {
        if($this->type !== null) {
            $this->andWhere(['type' => $this->type]);
        }
        return parent::prepare($builder);
    }
    


    /**
     * {@inheritdoc}
     * @return Car[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Car|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
