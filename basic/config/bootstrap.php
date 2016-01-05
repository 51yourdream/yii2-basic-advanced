<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/4
 * Time: 9:52
 */
//设置别名
//别名通常在一下位置设置
//别名一般放在 digpage.com\common\config\bootstrap.php ，
//或者 digpage.com\frontend\config\bootstrap.php 等 bootstrap.php 文件中定义。

Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
