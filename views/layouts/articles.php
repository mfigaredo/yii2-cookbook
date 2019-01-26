<?php 
/* @var $this yii\web\View */
$this->title = 'Articles...';
?>
<?php 
$this->beginContent('@app/views/layouts/main.php');
?>
<div class="container">
   <div class="col-md-8">
      <?= $content ?>
   </div>
   <div class="col-md-4">
      <h4>Table of Contents</h4>
      <ol>
         <li><a href="#intro">Introduction</a></li>
         <li><a href="#quick-start">Quick Start</a></li>
         <li><a href="#">....</a></li>
      </ol>
   </div>
</div>

<?php 
$this->endContent();
?>