<?php 
// $this->beginContent('//layouts/main');
$this->title = 'Blog!';
$this->beginContent('@app/views/layouts/main.php');

?>
<div class="col-md-8">
   <?= $content ?>
</div>
<div class="sidebar tags col-md-2">
   <ul>
      <li><a href="#php">PHP</a></li>
      <li><a href="#yii">Yii</a></li>
   </ul>
</div>
<div class="sidebar links col-md-2">
   <ul>
      <li><a href="http://www.yiiframework.php">Yii Framework</a></li>
      <li><a href="http://www.php.net">PHP.net</a></li>
   </ul>
</div>
<?php 
$this->endContent();
?>
