<?php

/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/9
 * Time: 16:35
 */
namespace app\event;
class testEvent extends \yii\base\Event
{
    public $datatime;
    public $username;
    public $age;

}