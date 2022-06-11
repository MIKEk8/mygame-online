<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(require __DIR__ . '/params.php',
    file_exists(__DIR__ . '/params-local.php') ? require __DIR__ . '/params-local.php' : []
);
$db = file_exists(__DIR__ . '/db-local.php') ? require __DIR__ . '/db-local.php' : require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'formatter' => [
            'sizeFormatBase' => 1000
        ],
        'request' => [
            'cookieValidationKey' => 'oEV24XKD2Kl23gnnbEMOC1-UJg7r-M',
            'enableCsrfValidation' => false,
            'baseURL' => '',
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache' //Включаем кеширование
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
        ],
        'errorHandler' => [
//            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'viewPath' => '@app/mail',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => 'ipoteka.fast.system@mail.ru',
            ],
            'transport' => [
                'class' => \Swift_SmtpTransport::class,
                'host' => 'smtp.sprintf.ru',
                'port' => '1027',
                'username' => 'admin',
                'password' => 'ener@forcecode.ru',
                'encryption' => null,
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
        'integrationRegister' => 'app\components\IntegrationRegister',
        'apiRequestLogger' => 'app\components\loggers\ApiRequestLogger',
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
