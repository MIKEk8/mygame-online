<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ShutterController extends Controller
{
    public function actionNewGame(): string
    {
        return $this->render('game', []);
    }
}