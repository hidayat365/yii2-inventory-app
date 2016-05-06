<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Items;
use app\models\TransactionTypes;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Transactions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transactions-form">

    <?php $form = ActiveForm::begin(['id' => 'transactions-form']); ?>

    <div class="row">
        <div class="col-sm-4 col-md-6">
		    <?= $form->field($model, 'trans_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4 col-md-3">
		    <?php 
				echo '<label class="control-label" for="transactions-trans_date">Transaction Date</label>';
				echo DatePicker::widget([
					'id' => 'transactions-trans_date',
				    'name' => 'Transactions[trans_date]',
				    'type' => DatePicker::TYPE_COMPONENT_APPEND,
				    'value' => date('Y-m-d'),
				    'pluginOptions' => [
				        'autoclose'=>true,
				        'format' => 'yyyy-mm-dd'
				    ]
				]);
		    ?>
        </div>
        <div class="col-sm-4 col-md-3">
		    <?= $form->field($model, 'type_id')->dropDownList(
		        ArrayHelper::map(TransactionTypes::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'* Pilih Transaksis *']                          // options
		    ); ?>
        </div>
        <div class="col-sm-12 col-md-12">
		    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- .row -->

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> Transaction Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',  // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items',          // required: css class selector
                'widgetItem' => '.item',                     // required: css class
                'limit' => 999,                                // the maximum times, an element can be cloned (default 999)
                'min' => 1,                                  // 0 or 1 (default 1)
                'insertButton' => '.add-item',               // css class
                'deleteButton' => '.remove-item',            // css class
                'model' => $details[0],
                'formId' => 'transactions-form',
                'formFields' => [
                    'trans_id',
                    'item_id',
                    'quantity',
                    'remarks',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($details as $i => $detail): ?>
                <div class="item row">
                    <?php
                        // necessary for update action.
                        if (! $detail->isNewRecord) {
                            echo Html::activeHiddenInput($detail, "[{$i}]id");
                        }
                    ?>
                    <div class="col-sm-8 col-md-4">
					    <?= $form->field($detail, "[{$i}]item_id")->dropDownList(
					        ArrayHelper::map(Items::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
					        ['prompt'=>'* Pilih Barang *']                          // options
					    ); ?>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <?= $form->field($detail, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-10 col-md-5">
                    	<?= $form->field($detail, "[{$i}]remarks")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-2 col-md-1 item-action">
                    	<div class="pull-right">
	                        <button type="button" class="add-item btn btn-success btn-xs">
	                        	<i class="glyphicon glyphicon-plus"></i></button> 
	                        <button type="button" class="remove-item btn btn-danger btn-xs">
	                        	<i class="glyphicon glyphicon-minus"></i></button>
                    	</div>
                    </div>
                </div><!-- .row -->

            <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
