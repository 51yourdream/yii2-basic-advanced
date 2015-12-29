<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true); //定义全局常量
defined('YII_ENV') or define('YII_ENV', 'dev'); //dev 表示开发模式 prod表示线上产品
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER',true);//标识是否启用 Yii 提供的错误处理，默认为 true。

require(__DIR__ . '/../vendor/autoload.php');  //注册composer自动加载器
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php'); //包含yii类文件

$config = require(__DIR__ . '/../config/web.php'); //加载应用配置

//创建应用实例并配置
(new yii\web\Application($config))->run(); //调用 yii\web\Application::run(); 来处理请求
