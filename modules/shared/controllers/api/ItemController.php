<?php

namespace app\modules\shared\controllers\api;

use app\modules\shared\models\Items;
use yii\rest\ActiveController;
 
/**
 * Item Controller API
 */
class ItemController extends ActiveController
{
    public $modelClass = Items::class;
}
