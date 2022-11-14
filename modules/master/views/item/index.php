<?php

use app\modules\master\models\ItemTypes;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Items'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'specification:ntext',

            [
                'attribute' => 'type_id', 
                'value' => function ($model, $index, $widget) { return isset($model->type) ? $model->type->name : null ; }, 
                'filter' => ArrayHelper::map(ItemTypes::find()->asArray()->all(), 'id', 'name'), 
                'filterInputOptions' => [ 'placeholder' => '*All*' ],
                'format' => 'raw',
                'contentOptions' => [ 'class' => 'kv-align-middle', 'width' => '10%' ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
