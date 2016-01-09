<?php

namespace app\controllers;

use app\event\testEvent;
use app\models\newuser\Newuser;
use app\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function actionEvent(){
        echo "这是事件处理<br/>";
        $newuser = new Newuser();
        $this->on('SayHello',[$newuser,'say_hello'],'abcdf'); //绑定事件 ancdf是绑定时触发的数据
        $this->on('SayHello',[$newuser,'say_hello1'],'你好，调用了say_hello1方法'); //绑定事件
        $this->on('SayGoodBye',['app\models\newuser\Newuser','say_goodbye'],'再见了!');
        $this->on('GoodNight',function(){
            echo '晚安';
        });
        $testEvent = new testEvent();
        $testEvent->datatime = date('Y-m-d H:i:s');
        $testEvent->username="lipeng";
        $testEvent->age="25";
//        $this->off("SayHello"); //解除全部事件
        $this->off('SayHello',[$newuser,'say_hello']); //解除指定事件
        $this->trigger('SayHello',$testEvent); //触发事件 $testEvent 是触发时间时绑定的数据
//        $this->trigger('SayHello');
        $this->trigger('SayGoodBye');
        $this->trigger('GoodNight');
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

//        $response = Yii::$app->response;
//        $response->format = \yii\web\Response::FORMAT_JSON;
//        return $response->data = ['message' => 'hello world'];
        $newuser = new Newuser();
        //给 yii\web\Response 事件 EVENT_AFTER_SEND 又添加了一个handler 即 [$newuser,'say_hello']
        Yii::$app->response->on(Response::EVENT_AFTER_SEND,[$newuser,'say_hello'],'你好，调用了say_hello方法');
        //$this->trigger(Response::EVENT_AFTER_SEND);
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

//    public function actionSay($message = 'Hello'){
//        return $this->render('say',['message'=>$message]);
//    }
    public function actionSay($message = 'Hello'){

        return $this->render('say',['message'=>$message]);
    }

    public function actionInfo()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => 'hello world',
            'code' => 100,
        ];
    }
    public function actionInfo1()
    {
        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => 'hello world',
                'code' => 101,
            ],
        ]);
    }
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
    public function actionDownload(){
        //yii\web\Response::sendFile(): 发送一个已存在的文件到客户端
        //yii\web\Response::sendContentAsFile(): 发送一个文本字符串作为文件到客户端
        //yii\web\Response::sendStreamAsFile(): 发送一个已存在的文件流作为文件到客户端
        $content = file_get_contents('../download/test.txt');
        $source = fopen('../download/test.txt','rb');
        //return Yii::$app->response->sendFile('../download/test.txt');
//        return Yii::$app->response->sendContentAsFile($content,'aa.txt');
        return Yii::$app->response->sendStreamAsFile($source,'bb.txt');
    }

}
