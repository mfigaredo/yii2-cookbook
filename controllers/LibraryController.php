<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class LibraryController extends Controller
{
  public function actionIndex()
  {



    $awesome = new \awesome\namespaced\Library();
    $content = '<pre>' . $awesome->method() . '</pre>';

    $old = new \OldLibrary();
    $content .=  '<pre>' . $old->method() . '</pre>';

    $content .=  '<pre>' . simpleFunction() . '</pre>';

    return $this->renderContent($content);

  }
}