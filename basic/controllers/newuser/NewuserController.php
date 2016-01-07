<?php

/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 13:47
 */
namespace app\controllers\newuser;
use Yii;
use app\models\newuser\NewuserSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;


class NewuserController extends Controller
{
    public function behaviors(){
        return [
            'verbs'=>[
                'class'=>VerbFilter::className(),
                'action'=>[
                    'delete'=>['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $newuserModel = new NewuserSearch()；
        $dataProvider = $newuserModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'newuserModel'=>$newuserModel,
            'dataProvider'=>$dataProvider,
        ]);
    }
}