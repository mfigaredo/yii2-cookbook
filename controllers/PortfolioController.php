<?php 
namespace app\controllers;
use yii\web\Controller;

class PortfolioController extends Controller
{
   public function actionIndex()
   {
      $this->view->title = 'My Portfolio...';
      return $this->render('//site/content');
   }

}
?>