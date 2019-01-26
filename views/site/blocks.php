<?php 
use yii\helpers\Html;
$this->title = 'Blocks Lesson';
/**
 * @var $this \yii\web\View
 */
?>

<?php 
   $this->beginBlock('beforeContent');
   echo Html::tag('pre', 'Your IP is ' . Yii::$app->request->userIP);
   $this->endBlock();
?>

<?php 
   $this->beginBlock('footer2');
   echo Html::tag('h3', 'My custom footer block');
   $this->endBlock();
?>

<h1>Blocks usage example</h1>
