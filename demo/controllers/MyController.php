<?php

namespace app\controllers;

use app\models\EntryForm;
use Yii;
use yii\web\Controller;

class MyController extends Controller
{
    public function actionSay($message = 'Hello'){
        
        return $this->render('say',['message'=>$message]);
    }
    public function actionEntry(){
        $model = new EntryForm();
        //Yii 的 yii\web\Request::post() 方法负责搜集  $_POST 搜集用户提交的数据
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            //验证$model 收到的数据

            return $this->render('entry-confirm',['model'=>$model]);
        }else{
            //无论初始化显示还是数据验证错误
            return $this->render('entry',['model'=>$model]);
        }
    }
}
