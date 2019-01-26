<?php 
namespace app\controllers;

use yii\web\Controller;

class BlogController extends Controller
{
   public function actionIndex()
   {
      $posts = [
         [
            'title' => 'First Post',
            'content' => 'There\'s an example of reusing views with partials.', 
         ],
         [
            'title' => 'Second Post',
            'content' => 'We use twitter widget.',
         ]
      ];
      return $this->render('index', compact('posts') );
   }

   public function actionIndex2()
   {
      
      $this->layout = 'blog';
      return $this->render('//site/content');
   }
   
}
?>