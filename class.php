<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/8
 * Time: 20:13
 */
use yii\web\Request;
$request = Yii::$app->request;
$request->get(); //$_GET;
$request->post();//$_POST;

$id = $request->get('id'); //$_GET['id];

$id = $request->get('id',2); //等价于 如果存在 $_GET['id'] 则 $id=$_GET['id'] 否则 $id=2;

$request->post(); //方法同get

//当实现了 RESTful APIs 接口的时候，经常需要获取通过PUT,PATCH或者其他的 request methods
//请求方式提交上来的参数。可以通过调用 yii\web\Request::getBodyParam()方法获取这些数据

$request = Yii::$app->request;
//返回所有参数
$params = $request->bodyParams;
//获取指定参数
$param = $request->getBodyParam('id');

//判断当前请求时什么HTTP方法 get post ajax put
$request = Yii::$app->request;
if($request->isAjax){/*请求是ajax*/}
if($request->isGet){/*请求是get*/}
if($request->isPost){/*请求是post*/}
if($request->isPut){/*请求是PUT*/}

