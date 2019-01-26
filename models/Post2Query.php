<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Post2]].
 *
 * @see Post2
 */
class Post2Query extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return Post2[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);

    }

    /**
     * {@inheritdoc}
     * @return Post2|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $lang
     * @return $this
     */
    public function lang($lang)
    {
        return $this->where(['lang' => $lang]);
    }
}
