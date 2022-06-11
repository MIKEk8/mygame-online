<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ShuterController extends Controller
{

    /**
     * Мониторинг
     */
    public function actionNewGame()
    {
        $params = Yii::$app->params;
        var_dump($params);
        /*        return $this->render('index', [
                    'params' => $params
                ]);*/
    }
}