<?php

/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 13:47
 */
namespace app\controllers;
use app\models\newuser\Newuser;
use app\models\Orders;
use Yii;
use app\models\newuser\NewuserSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class NewuserController extends Controller
{
    public function behaviors(){
        return [
            'verbs'=>[
                'class'=>VerbFilter::className(),
                'actions'=>[
                    'delete'=>['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $newuserModel = new NewuserSearch();
        $dataProvider = $newuserModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'newuserModel'=>$newuserModel,
            'dataProvider'=>$dataProvider,
        ]);
    }
    public function actionView($id){
        return $this->render('view',[
            'model'=>$this->findModel($id),
        ]);
    }
    public function actionCreate(){
       $model = new Newuser();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view','id'=>$model->id]);
        }else{
           return $this->render('create',[
               'model'=>$model,
           ]);
        }
    }
    protected function findModel($id){
        if(($model = Newuser::findOne($id)) !== null){
            return $model;
        }else{
            throw new NotFoundHttpException('当前页不见了');
        }
    }
    public static function userRole($role){
        $role_arr = [
            10=>'超级管理员',
            11=>'普通管理员'
        ];
        return $role_arr[$role] ?  $role_arr[$role]: '普通人';
    }
}