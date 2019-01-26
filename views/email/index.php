<?php 
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use app\models\EmailForm;

// $t = Yii::$app->session->removeFlash('success');
?>

<?php if(Yii::$app->session->hasFlash('success')): ?>
	<!--
	<div class="alert alert-success">
		<?= Yii::$app->session->getFlash('success') ?>	
	</div>
-->
<?php $model = new EmailForm(); endif; ?>
	<?php $form = ActiveForm::begin() ?>
	<div class="control-group">
		<div class="controls">
			<?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'autofocus' => 'autofocus']); ?>
			<?= Html::error($model, 'email', ['class' => 'help-block']); ?>
		</div>
	</div>

	<?php 
		if(Captcha::checkRequirements() && Yii::$app->user->isGuest): 
	 ?>
	<div class="control-group">
		<?php 
			/*
			echo  Captcha::widget([
			'model' => $model,
			'attribute' => 'verifyCode',	
			]); 
			echo Html::error($model, 'verifyCode');
			*/
		?>
		<?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(),[
			'captchaAction' => $model->math ? 'email/mathcaptcha' : 'email/captcha',
		]) ?>
		
	</div>
	<?php endif; ?>


	<div class="control-group">
		<label class="control-label" for=""></label>
		<div class="controls">
			<?= Html::submitButton('Submit',['class' => 'btn btn-success']); ?>
		</div>
	</div>
	<?php ActiveForm::end() ?>
<?php //endif; ?>
