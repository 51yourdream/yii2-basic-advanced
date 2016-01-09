<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/9
 * Time: 17:03
 */

class userEvent extends \yii\base\Event{

    public $company;
    public $time;
    public $news;
}

class user extends \yii\db\ActiveRecord{
    const EVENT_SEND_MSG = 'send_msg'; //发送信息事件
    const  EVENT_OFFER_MSG = 'offer_msg';//发送offer事件

    public function on_send_msg($event){
        //在这里面做其他自定义操作
        $event->data; //获取事件绑定时所携带的参数
        $event->company; //获取时间触发时绑定的参数
    }

    public function on_offer_msg($event){
        //在这里面做事件其他操作 跟上面一样
    }

}

class userController extends \yii\base\Controller{

    public function actionEvent(){ //绑定事件测试
        $user = new user();
        $user->on($user::EVENT_SEND_MSG,[$user,'on_send_msg'],'发送信息事件'); //绑定事件EVENT_SEND_MSG
        $user->on($user::EVENT_OFFER_MSG,[$user,'on_send_msg'],'发送信息事件'); //绑定事件EVENT_OFFER_MSG

        $user->trigger($user::EVENT_SEND_MSG); //触发事件不传额外参数

        $userEvent = new userEvent();

        $userEvent->company="乾坤翰林";
        $userEvent->time=date('Y-m-d H:i:s');
        $userEvent->news="今天发工资";

        $user->trigger($user::EVENT_OFFER_MSG,$userEvent); //触发事件传递额外参数
    }
}