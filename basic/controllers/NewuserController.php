<?php

/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 13:47
 */
namespace app\controllers;

use app\models\newuser\Newuser;
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
        $newuserModel->scenario="create";
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
    public function actionLogin(){
       $model = new Newuser();
        $model->setScenario('create');
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view','id'=>$model->id]);
        }else{
           return $this->render('create',[
               'model'=>$model,
           ]);
        }
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $model->setScenario('update');
        if($model->load(Yii::$app->request->post()) && $model->save()){
            $this->redirect(['view','id'=>$model->id]);
        }else{
            return $this->render('update',[
                'model'=>$model
            ]);
        }
    }

    public function actionLogin1(){
        $model = new Newuser();
//        $model->scenario="create";
        $data = Yii::$app->request->post('Newuser');
//        error_log(print_r($data,1));
        error_log(print_r($model::findByUsername($data['username'],$model::encryptPassword($data['password'])),1));
        if($model->load(Yii::$app->request->post()) && $model::findByUsername($data['username'],$model::encryptPassword($data['password']))){
            error_log(21132);
            $_SESSION['usernews']=1;
            $this->redirect(['site/index']);
        }else{
            return $this->render('login',[
                'model'=>$model
            ]);
        }
    }
    public function actionDelete($id){
        $this->findModel($id)->delete();
        $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Newuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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