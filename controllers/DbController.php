<?php 
namespace app\controllers;

use app\models\Actor;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\Post2;

/**
 * Class DbController
 * @package app\controllers
 */

class DbController extends Controller
{
   /*
   public function __construct() {
      $this->view->title = 'DB Controller';
      // var_dump($this->module);
      // die();
      parent::__construct($this->id, $this->module ?: Yii::$app);
   }
   */

   public function beforeAction($action)
   {
      if(!parent::beforeAction($action)) return false;
      $this->view->title = 'DB Controller Examples';
      return true;
   }
   /**
    * Example of ActiveRecord usage
    *
    * @return string
    */
   
   public function actionAr()
   {
      $records = Actor::find()
                     ->joinWith('films')
                     ->orderBy('actor.first_name, actor.last_name, film.title')
                     ->all();
      return $this->renderRecords($records);

   }

   /**
    * Example of Query Class usage
    * @return string
    */
   public function actionQuery()
   {
      $rows = (new Query())
                  ->from('actor')
                  ->innerJoin('film_actor','actor.actor_id = film_actor.actor_id')
                  ->leftJoin('film', 'film.film_id = film_actor.film_id')
                  ->orderBy('actor.first_name, actor.last_name, actor.actor_id, film.title')
                  ->all(Yii::$app->db_sakila);

      return $this->renderRows($rows);
                  
   }

   /**
    * Example of SQL execution usage
    * @return string
    */
   public function actionSql()
   {
      $sql = 'SELECT *
               FROM actor a
               JOIN film_actor fa ON fa.actor_id = a.actor_id
               JOIN film f ON fa.film_id = f.film_id
               ORDER BY a.first_name, a.last_name, a.actor_id, f.title';
      
      $rows = Yii::$app->db_sakila->createCommand($sql)->queryAll();

      return $this->renderRows($rows);

   }

   /**
    * Render Records for Active Record array
    * @param array $records
    * @return string
    */
   protected function renderRecords(array $records = [])
   {
      if( !$records ) {
         return $this->renderContent('Actor list is empty');
      }
      $items = [];
      foreach( $records as $record ) {
         $actorFilms = $record->films ? Html::ol(ArrayHelper::getColumn($record->films,'title')) : null;
         $actorName = $record->first_name . ' ' . $record->last_name;
         $items[] = $actorName . $actorFilms; 

      }

      return $this->renderContent(Html::ol($items,['encode' => false]));
   }

   /**
    * Render Rows for result of Query
    * @param array $rows
    * @return string
    */
   protected function renderRows(array $rows = [])
   {
      if( !$rows ) {
         return $this->renderContent('Actor list is empty');
      }

      $items = [];
      $films = [];
      $actorId = null;
      $actorName = null;
      $actorFilms = null;

      $lastActorId = $rows[0]['actor_id'];

      foreach($rows as $row) {
         $actorId = $row['actor_id'];
         $films[] = $row['title'];
         if( $actorId != $lastActorId) {
            $actorName = $row['first_name'] . ' ' . $row['last_name'];
            $actorFilms = $films ? Html::ol($films) : null;
            $items[] = $actorName . $actorFilms;
            $films = [];
            $lastActorId = $actorId;
         }

      }

      if($actorId == $lastActorId) {
         $actorFilms = $films ? Html::ol($films) : null;
         $items[] = $actorName . $actorFilms;
      }

      return $this->renderContent(Html::ol($items, ['encode' => false]));
   }

   public function actionActiveQuery()
   {
      // Get posts written in default application language
      $posts = Post2::find()->active()->all();

      $content = Html::tag('h1','Default Language');
      foreach($posts as $post) {
         $content .= Html::tag('h2',$post->title);
         $content .= Html::tag('p',$post->text);
      }

      // $command = Post2::find()->active()->createCommand()->sql;
      // var_dump($command->sql);
      // die();

      $content .= Html::tag('pre','SQL: ' . Post2::find()->active()->createCommand()->sql);

      // Get posts written in German
      $posts = Post2::find()->active()->lang('de')->all();
      $content .= Html::tag('h1','German');
      foreach($posts as $post) {
         $content .= Html::tag('h2',$post->title);
         $content .= Html::tag('p',$post->text);
      }

      $command = Post2::find()->active()->lang('de')->createCommand();
      // var_dump($command->sql);
      // var_dump($command->params);
      // die();

      $content .= Html::tag('pre','SQL: ' . $command->sql . PHP_EOL . 'Params: ' . json_encode($command->params));
      return $this->renderContent($content);

   }
}

?>