<?php  
namespace app\models;

use app\components\WordsValidator;
use yii\base\Model;

class Article2 extends Model
{
	public $title;
	public function rules()
	{
		return [
			['title', 'string'],
			['title', WordsValidator::className(), 'size' => 10],
		];
	}
}

?>