<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Transactions */

$this->title = $model->trans_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Back to List'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'trans_code',
            [
                'attribute' => 'trans_date',
                'format' => [ 'date', 'php: d-M-Y' ],
                'labelColOptions' => [ 'style'=>'width:30%; text-align:right;' ]
            ],
            'type.name',
            'remarks',
        ],
    ]) ?>

    <div class="item panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title pull-left"><i class="glyphicon glyphicon-barcode"></i> Transaction Line Item</h3>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $details,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'item_id',
                        'value' => 'item.code',
                        'header' => 'Item Code',
                    ],
                    [
                        'attribute' => 'item_id',
                        'value' => 'item.name',
                        'header' => 'Item Name',
                    ],
                    'quantity',
                    'remarks',
                ],
            ]); ?>
        </div>
    </div>

</div>
