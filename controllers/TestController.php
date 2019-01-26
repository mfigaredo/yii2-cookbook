<?php 

namespace app\controllers;
use Yii;
use app\models\Post;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use app\models\BlogPost;
use app\models\User;
use Faker;
// use fzaninotto\Faker\Factory;
/**
 * Class TestController.
 * @package app\controllers
 */
class TestController extends Controller
{
	public function actionIndex()
	{
		$post = new Post();
		$post->title = 'link test';
		$post->text = 'before http://yiiframework.com after https://google.com other ftps://8.8.16.16/MyDir/myFile.txt end';
		$post->save();

		return $this->renderContent(Html::tag('pre', VarDumper::dumpAsString($post->attributes)) 
			. '<br>' . Html::tag('p',$post->text));

	}

	public function actionTimestamp()
	{
		$faker = Faker\Factory::create();

		$users = new User();
		$identity = $users->findIdentity(100);
		Yii::$app->user->setIdentity($identity);

		$blogPost = new BlogPost();
		// $blogPost->title = 'Gotcha!';
		$blogPost->title = $faker->sentence(rand(3,12));
		// $blogPost->text = 'We need some laughter to ease the tension of holiday shopping.';
		$blogPost->text = $faker->paragraph(rand(2,6));

		// $blogPost->detachBehavior('blameable');
		// $blogPost->detachBehavior('timestamp');
		$blogPost->save();

		// $blogPost->touch('modified_date');
		sleep(3);
		$blogPost->text = 'UPDATED: ' . $blogPost->text;
		Yii::$app->user->setIdentity( (new User())->findIdentity(101) );
		$blogPost->save();

		// Load blogPost from DB 
		/*
		$id = $blogPost->id;
		unset($blogPost);
		$blogPost = BlogPost::findOne($id);
		*/
	
		return $this->renderContent(Html::tag('pre', VarDumper::dumpAsString($blogPost->attributes)) 
			. Html::tag('p','Fecha creación ' . $blogPost->getDate('created_date')) 
			. Html::tag('p','Fecha actualización ' . $blogPost->getDate('modified_date'))
				. '<br>' . Yii::$app->formatter->asDatetime( $blogPost->created_date )
		);
	}

}

 ?>