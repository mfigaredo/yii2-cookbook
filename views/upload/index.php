<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'File Upload Example';
?>
<?php 
	// $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
	$form = ActiveForm::begin(); // Yii2 automatically detects file inputs and adds enctype on form
?>
<?php echo $form->field($model,'file')->fileInput(); ?>
<?php echo Html::submitButton('Upload',[
		'class' => 'btn btn-success'
	]); ?>
<?php ActiveForm::end(); ?>
