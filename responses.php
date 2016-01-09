<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/8
 * Time: 20:13
 */
use yii\web\Response; //请求组件

//响应头部设置
$header = Yii::$app->response->headers;
//增加一个 pragma头已存在的pragma头不会被覆盖
$header->add('Pragma','no-cache');
//设置一个pragma头，任何已存在的pragma头都会被丢弃
$header->set('Pragma','no-cache');
//删除progma头并返回删除的pragma头到数组
$values = $header->remove('Pragma');

//响应格式
//如果在发送到终端用户前需要格式化,应设置yii\web\Response::format 和yii\web\Response\data属性
//yii\web\Response::format属性指定yii\web\Response::data中数据格式化后的样式

$response = Yii::$app->response;
$response->format = \yii\web\Response::FORMAT_JSON;
$response->data = ['message' => 'hello world']; //返回输出 json格式

//Yii支持一下直接使用格式
//可自定义这些格式器或通过配置yii\web\Response::formatters 塑性来增加格式器
//yii\web\Response::FORMAT_HTML: 通过 yii\web\HtmlResponseFormatter 来实现.
//yii\web\Response::FORMAT_XML: 通过 yii\web\XmlResponseFormatter来实现.
//yii\web\Response::FORMAT_JSON: 通过 yii\web\JsonResponseFormatter来实现.
//yii\web\Response::FORMAT_JSONP: 通过 yii\web\JsonResponseFormatter来实现.

public function actionInfo()
{
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //一下内容会以json格式输出
    return [
        'message' => 'hello world',
        'code' => 100,
    ];
}
//除了使用默认的response 应用组件，也可创建自己的响应对象并发送给终端用户
//可在操作方法中返回该响应对象
public function actionInfo()
{
    return \Yii::createObject([
        'class' => 'yii\web\Response',
        'format' => \yii\web\Response::FORMAT_JSON,
        'data' => [
            'message' => 'hello world',
            'code' => 100,
        ],
    ]);
}

//浏览器跳转
public function actionOld(){
    return $this->redirect('url'[,'状态码']);
}

//方法二
//操作方法外，可直接调用yii\web\Response::redirect() 再调用 yii\web\Response::send() 方法来确保没有其他内容追加到响应中。
Yii::$app->response->redirect('url','状态码')->send();

//发送文件主要做下载
//文件发送是另一个依赖指定HTTP头的功能4
//Yii提供方法集合来支持各种文件发送需求
//它们对HTTP头都有内置的支持。
public function actionDownload(){
    //yii\web\Response::sendFile(): 发送一个已存在的文件到客户端
    //yii\web\Response::sendContentAsFile(): 发送一个文本字符串作为文件到客户端
    //yii\web\Response::sendStreamAsFile(): 发送一个已存在的文件流作为文件到客户端
    return Yii::$app->response->sendFile('path/to/file.txt');
}

//注意如果不是在 操作方法方法中调用文件发送方法
//在后面还应调用 yii\web\Response::send();没有其他内追加到响应中
Yii::$app->response->sendFile('要下载的文件')->send();

//发送响应
//在yii\web\Response::send()方法前响应中的内容不会发送给用户，
//该方法默认在yii\base\Application::run()结尾自动调用,
//尽管如此，可以明确调用该方法立即发送响应

