<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transactions */

$this->title = Yii::t('app', 'Create Transactions In');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions In'), 'url' => ['in']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (isset($error)): ?>
    	<div class="alert alert-danger" role="alert"><?= Html::encode($error) ?></div>
    <?php endif; ?>
    
    <?= $this->render('_form-inout', [
        'model' => $model,
        'details' => $details,
    ]) ?>

</div>
