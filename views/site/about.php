<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="col-md-7">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            This is the About page. You may modify the following file to customize its content:
        </p>
        <code><?= __FILE__ ?></code>
    </div>
    <div class="col-md-5">
        <?= $this->render('//common/twitter', [
            'widget_id' => '1',
            'screen_name' => 'vuejs',
        ]); ?>
    </div>
</div>
