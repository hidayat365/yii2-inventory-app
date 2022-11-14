<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trans_id')->textInput() ?>
    <?= $form->field($model, 'item_id')->textInput() ?>
    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
