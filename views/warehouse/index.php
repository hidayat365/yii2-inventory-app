<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Locations;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WarehousesearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Warehouses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Warehouses'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            [
                'attribute' => 'location_id', 
                'value' => function ($model, $index, $widget) { return isset($model->location) ? $model->location->name : null ; }, 
                'filter' => ArrayHelper::map(Locations::find()->asArray()->all(), 'id', 'name'), 
                'filterInputOptions' => [ 'placeholder' => '*All*' ],
                'format' => 'raw',
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '10%' ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

