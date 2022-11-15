<?php

use app\models\TransactionTypes;
use app\models\Warehouses;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions');
$this->params['breadcrumbs'][] = $this->title;

// ambil list jenis transaksi untuk filtering
$typeList = ArrayHelper::map(TransactionTypes::find()->asArray()->all(), 'id', 'name');
$warehouseList = ArrayHelper::map(Warehouses::find()->asArray()->all(), 'id', 'name');

?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Transactions'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Transactions In'), ['create-in'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Create Transactions Out'), ['create-out'], ['class' => 'btn btn-primary']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'trans_code',
            'trans_date',
            [   'attribute' => 'type_id', 
                'filter' => $typeList, 
                'label' => 'Transaction Type', 
                'value' => function ($model, $index, $widget) { return $model->type->name; }
            ],
            [   'attribute' => 'warehouse_id', 
                'filter' => $warehouseList, 
                'value' => function ($model, $index, $widget) { return $model->warehouse->name; }
            ],
            'remarks',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
