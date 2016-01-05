<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/5
 * Time: 11:24
 */
question1
    运行提示vendor\bower/jquery/dist文件不存在
    解决办法
    /vendor/yiisoft/yii2/base/Application.php :456行

// 注释掉
//Yii::setAlias('@bower', $this->_vendorPath . DIRECTORY_SEPARATOR . 'bower');
// 替换成
//Yii::setAlias('@bower', $this->_vendorPath . DIRECTORY_SEPARATOR . 'bower' . DIRECTORY_SEPARATOR . 'bower-asset');