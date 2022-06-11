<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \Yii;
use const YII_ENV_DEV;

class SiteController extends Controller
{

    /**
     * Мониторинг
     */
    public function actionIndex()
    {
        //Yii::debug(['short' => "Test\nmessage", 'add' => ['ctxt_test' => 'test']], 'external_api');
        $params = Yii::$app->params;
        return $this->render('index', [
            'params' => $params
        ]);
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

    public function actionTest()
    {
        if (!YII_ENV_DEV) {
            throw new NotFoundHttpException();
        }
        $cacheKey = 'cache_test';
        echo ('Getting data from cache: <br/>');
        $cachedData = Yii::$app->cache->getOrSet($cacheKey, function () use ($cacheKey) {
            echo('No data; setting cache...<br/>');
            return sprintf('[%s] Test ok!', (new \DateTime('now'))->format(DATE_ATOM));
        }, 60);
        echo("Data from cache: <br/> $cachedData");
    }

    public function actionPermissions()
    {
        if (!YII_ENV_DEV) {
            throw new NotFoundHttpException();
        }
        var_dump(substr(sprintf('%o', fileperms(Yii::getAlias('@runtime/cache'))), -4));
    }

}
