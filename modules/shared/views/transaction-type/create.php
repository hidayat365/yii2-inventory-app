<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TransactionTypes */

$this->title = 'Create Transaction Types';
$this->params['breadcrumbs'][] = ['label' => 'Transaction Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
