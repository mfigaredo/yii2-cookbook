<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post2".
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $text
 */
class Post2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['lang'], 'string', 'max' => 5],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang' => 'Lang',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    /**
     * {@inheritdoc}
     * @return Post2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Post2Query(get_called_class());
    }
}
