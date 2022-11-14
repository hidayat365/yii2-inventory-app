<?php

namespace app\modules\shared\controllers;

use yii\web\Controller;

/**
 * Default controller for the `shared` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
