<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TiAvSKt1htIitfc2ri3w',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
         // 'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'service'],
            ],
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
//        'db' => require(__DIR__ . '/db-dev.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    $config['components']['request']['cookieValidationKey'] = 'TiAvSKt1htIitfc2ri3w';
    $config['components']['db'] = require(__DIR__ . '/db.php');
} elseif (YII_ENV_INTEGRATION) {
    $config['components']['request']['cookieValidationKey'] = 'TiAvSKt1htIitfc2ri3w';
    $config['components']['db'] = require(__DIR__ . '/db.php');
} elseif (YII_ENV_QA) {
    $config['components']['request']['cookieValidationKey'] = 'TiAvSKt1htIitfc2ri3w';
    $config['components']['db'] = require(__DIR__ . '/db.php');
}

return $config;
