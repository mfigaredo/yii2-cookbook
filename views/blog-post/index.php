<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
$fmt = Yii::$app->formatter;
?>
<div class="blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        // 'showHeader' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'text:ntext',
            // 'created_date:datetime',
            // 'modified_date:datetime',
            // 'author_id',
            // 'updater_id',
            ['content' => function($item) use($fmt) { 
                        return '<small>' . $fmt->asDatetime($item->created_date) . '<br>' . $fmt->asDatetime($item->modified_date) . '</small>'; 
                        },
                        'format' => 'raw',
                        'label' => 'Created|Modified',
                        'enableSorting' => true,
                        'attribute' => 'dates',
                    ],
            [
                'content' => function($item) {
                    return $item->getDates();
                },
                'label' => 'fechas',
                'enableSorting' => true,
                'attribute' => 'dates',
                'format' => 'raw',
            ],
           ['content' => function($item) { return $item->author_id . ' | ' . $item->updater_id; },
                        'label' => 'Author|Updater',
                        'enableSorting' => true,
                        'attribute' => 'author',
                    ],
            'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
