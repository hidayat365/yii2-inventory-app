<?php

namespace app\modules\shared\controllers\api;

use app\modules\shared\models\Items;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class RestController extends ActiveController
{
    // adjust the model class to match your model
    public $modelClass = Items::class;

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
