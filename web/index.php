<?php

// comment out the following two lines when deployed to production
// 环境配置
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


// 依赖加载
// 实现自动加载
require(__DIR__ . '/../vendor/autoload.php');

// 框架加载
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');


// 运行入口
// (new yii\web\Application($config))->run();


// 
$app = new yii\web\Application($config);

$app->run();