<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */
$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;

if(false) {
	echo "<pre>";
	echo Vardumper::dumpAsString($dataProvider->allModels);
	echo "</pre>";
}

?>
<div class="cart-index">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
		<div class="col-md-6">
			<p><?= Html::a('Add Item', ['add'], ['class' => 'btn btn-success']) ?></p>
		</div>
		<div class="col-md-6">
			<? if(count($dataProvider->allModels)>0): ?>
			<p><?= Html::a('Clear Cart', ['clear'], ['class' => 'btn btn-danger', 'data-confirm' => 'You sure?', 'data-method' => 'post']) ?></p>
			<? endif; ?>
		</div>
	</div>
	<?php if (Yii::$app->session->hasFlash('cartCleared')): ?>

        <div class="alert alert-success">
            Cart has been cleared.
        </div>
    <?php endif; ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => SerialColumn::className() ],
			'id:text:Product ID',
			'amount:text:Amount',
			[
				'class' => ActionColumn::className(),
				'template' => '{delete}',
			],
		],
	]) ?>
</div>