<?php
use yii\web\Session; //session组件
//session 在yii中被封装成了一个session对象
//开启关闭session
$session = Yii::$app->session; //session对象

//检查session是否开启
if($session->isActive){}

//开启session
$session->open();

//关闭sesssion
$session->close();

//销毁session中已经注册的数据

$session->destroy();

//session数据的处理

//获取sesssion中的变量值有一下三种方法
$username = $session->get('username');
$username = $session['username'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

//设置session变量
$session->set('username','lipeng');
$session['username'] = 'lipeng';
$_SESSION['username'] = 'lipeng';

//删除一个session变量
$session->remove('username');
unset($session['username']);