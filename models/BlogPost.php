<?php

namespace app\models;

use Yii;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "blog_post".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $created_date
 * @property int $modified_date
 * @property int $author_id
 * @property int $updater_id
 * @property string $slug
 */
class BlogPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'slug'], 'required'],
            [['text'], 'string'],
            [['created_date', 'modified_date', 'author_id', 'updater_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'author_id' => 'Author ID',
            'updater_id' => 'Updater ID',
            'slug' => 'Slug',
        ];
    }

   /** 
    * @return array 
    */ 
   public function behaviors() 
   { 
       return [ 
           'timestamp' => [ 
               'class' => 'yii\behaviors\TimestampBehavior', 
               'createdAtAttribute' => 'created_date', 
               'updatedAtAttribute' => 'modified_date', 
           ], 
           'blameable' => [ 
               'class' => 'yii\behaviors\BlameableBehavior', 
               'attributes' => [ 
                   BaseActiveRecord::EVENT_BEFORE_INSERT => 'author_id', 
                   BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updater_id', 
               ], 
           ], 
           'sluggable' => [ 
               'class' => 'yii\behaviors\SluggableBehavior', 
               'attribute' => 'title', 
               'slugAttribute' => 'slug', 
               'immutable' => false, 
               'ensureUnique' => true, 
           ],
       ]; 
   } 
 
   public function getDate($field) { 
       return date("d/m/Y H:i:s", $this->$field); 
   } 

   public function getDates()
    {
        $fmt = Yii::$app->formatter;
        return '<small>' . $fmt->asDatetime($this->created_date) . '<br>' . $fmt->asDatetime($this->modified_date) . '</small>'; 
    }
}
