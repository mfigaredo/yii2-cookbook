<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ViewController extends Controller
{
   public $pageTitle;

   public function actionIndex()
   {
      $this->pageTitle = 'Controller Context Test';
      var_dump(Yii::$app->request);
      return $this->render('index');
   }

   public function hello()
   {
     
      $name = Yii::$app->request->get('name','default');
      if(!empty($name)) {
         echo 'Hello, ' . $name . '!';
      }
   }

}
?>

