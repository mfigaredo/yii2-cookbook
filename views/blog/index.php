<?php 
/**
 * @var $category string
 * @var $posts array
 * @var $this \yii\web\View
 */
$this->title = 'Blog';
?>

<div class="row">
   <div class="col-md-7">
      <h1>Posts</h1>
      <hr>
      <?php foreach ($posts as $post):?>
         <h3><?= $post['title'] ?></h3>
         <p><?= $post['content'] ?></p>
      <?php endforeach; ?>
   </div>
   <div class="col-md-5">
      <?= $this->render('//common/twitter',[
         'widget_id' => '1',
         'screen_name' => 'yiiframework',
      ]); ?>
   </div>
</div>