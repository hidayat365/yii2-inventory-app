<?php

namespace app\controllers;

use app\models\ItemTransactions;
use yii\data\ActiveDataProvider;

class StatusController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$provider = new ActiveDataProvider([
		    'query' => ItemTransactions::find(),
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);
        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

}
