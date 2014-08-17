<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);

// YII_ENV has to be set nginx config as fastcgi_param
//         or in apache2 environment
defined('YII_ENV') or define('YII_ENV', $_SERVER["APP_ENV"]);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
