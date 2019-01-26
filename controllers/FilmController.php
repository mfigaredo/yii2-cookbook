<?php 
namespace app\controllers;

use app\models\Film;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\Sort;

class FilmController extends Controller
{
   public function actionIndex()
   {
      $query = Film::find();
      $countQuery = clone $query;
      $pages = new Pagination([
         'totalCount' => $countQuery->count(),
         'pageSize' => 20,
      ]);
      // $pages->pageSize = 500;

      $sort = new Sort([
         'attributes' => [
            'title',
            'rental_rate',
         ],
      ]);

      $models = $query->offset($pages->offset)
                     ->limit($pages->limit)
                     ->orderBy($sort->orders)
                     ->all();

      \Yii::info($pages->limit,'custom');               

      return $this->render('index',[
         'models' => $models,
         'sort' => $sort,
         'pages' => $pages,
      ]);

   }
}

?>