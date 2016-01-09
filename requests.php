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

//========================================
// yii\web\Request::headers 属性返回 yii\web\HeaderCollection 对象 该对象可以获取 HTTP信息
$header = Yii::$app->request->headers;
//返回 Accept header值
$accept = $header->get('Accept');

//请求组件也提供了 支持快速访问头常用方法
Yii::$app->request->userAgent; //返回浏览器头
Yii::$app->request->contentType; //返回Content-Type Content_Type 是请求体中的 MIME类型数据

Yii::$app->request->acceptableContentTypes; // array  返回用户可接受的内容MIME类型。 返回的类型是按照他们的质量得分来排序的。得分最高的类型将被最先返回。

Yii::$app->request->acceptableLanguages;//array 返回课接受的语言

//获取客户端信息
$userhost = Yii::$app->request->userHost;
Yii::$app->request->getUserHost();
Yii::$app->request->headers->get('host');
Yii::$app->request->getUserIP();
Yii::$app->request->userIP;


