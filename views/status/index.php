<?php

use yii\grid\GridView;
/* @var $this yii\web\View */
?>
<h1>Item Transactions</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'trans_code',
            'trans_date',
            'item_code',
            'item_name',
            'quantity',
            'remarks',
        ],
    ]); ?>
