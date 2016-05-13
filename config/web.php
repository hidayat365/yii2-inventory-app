<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'cookieValidationKey',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
          'class' => 'yii\web\UrlManager',
          // Disable index.php
          'showScriptName' => false,
          // Disable r= routes
          'enablePrettyUrl' => true,
          'rules' => array(
            '<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
            '<controller:[\w\-]+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:[\w\-]+>/<action:\w+>' => '<controller>/<action>',
          ),
        ],
        /*
        'urlManager' => [
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'ItemRest'],
            ],
        ],
        */
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
