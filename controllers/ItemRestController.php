<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class ItemRestController extends ActiveController
{
    // adjust the model class to match your model
    public $modelClass = 'app\models\Items';

    // required for granting access to third party code
    // i.e. AJAX calls from external domain.
    public function behaviors()
    {
        return
        ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
    }
}
