<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transactions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transactions',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transactions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (isset($error)): ?>
    	<div class="alert alert-danger" role="alert"><?= Html::encode($error) ?></div>
    <?php endif; ?>
    
    <?= $this->render('_form', [
        'model' => $model,
        'details' => $details,
    ]) ?>

</div>
