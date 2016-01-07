<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 14:54
 */
$this->title = $model->username;

$this->params['breadcrumbs'][] = ['label'=>'用户管理','url'=>['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newuser-view">
    <h1><?= \yii\helpers\Html::encode($this->title);?></h1>
    <p>
        <?= \yii\helpers\Html::a('修改',['update','id'=>$model->id],['class'=>'btn btn-primary']);?>
        <?= \yii\helpers\Html::a('删除',['delete','id'=>$model->id],[
           'class'=>'btn btn-danger',
            'data'=>[
                'confirm'=>'确定要删除吗?',
                'method'=>'post',
            ]
        ]);?>
    </p>
<!--    小部件 yii\widgets\DetailView  小部件显示的是单一 yii\widgets\DetailView::$model 数据的详情。-->
    <?= \yii\widgets\DetailView::widget([
        'model'=>$model,

        'attributes'=>[
            'username:html',
            'email',
            [
                'label'=>'角色',
                'value'=>\app\controllers\NewuserController::userRole($model->role),
            ],
            'create_time:datetime'
        ]
    ])?>

</div>
