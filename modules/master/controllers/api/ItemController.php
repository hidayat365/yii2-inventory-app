<?php

namespace app\controllers;
 
use yii\rest\ActiveController;
 
/**
 * Item Controller API
 */
class ItemController extends ActiveController
{
    public $modelClass = 'app\models\Items';
}
