<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \Yii;


class SiteController extends Controller
{

    /**
     * Мониторинг
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * PHPINFO.
     */
    public function actionInfo()
    {
        if (!YII_ENV_DEV) {
            throw new NotFoundHttpException();
        }
        phpinfo();
    }

    public function actionPermissions()
    {
        if (!YII_ENV_DEV) {
            throw new NotFoundHttpException();
        }
        var_dump(substr(sprintf('%o', fileperms(Yii::getAlias('@runtime/cache'))), -4));
    }

}
