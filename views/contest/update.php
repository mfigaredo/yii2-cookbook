<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$contest_id = -1;
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);

foreach($prizes as $i => $prize) {
	// echo $form->field($prize, 'id');
	if($prize->contest->id != $contest_id) {
		echo Html::tag('h3',$prize->contest->name);
		$contest_id = $prize->contest->id;
	}
	echo $form->field($prize, "[$i]amount")->label($prize->prize->name);
}
echo Html::submitButton('Submit', ['class' => 'btn btn-success']);
ActiveForm::end();
?>
