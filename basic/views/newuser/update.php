<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/8
 * Time: 15:11
 */
$this->title = "修改用户".$model->username."信息";
$this->params['breadcrumbs'][]  =['label'=>'用户管理','url'=>['index']];
$this->params['breadcrumbs'][] = ['label'=>$model->username,'url'=>['view','id'=>$model->id]];
$this->params['breadcrumbs'][]  = '修改';

?>
<div class="newuser-update">
    <h1><?= \yii\helpers\Html::encode($this->title);?></h1>
    <?= $this->render('_form',[
        'model'=>$model,
    ]);?>
</div>
