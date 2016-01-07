<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 18:14
 */
$this->title="添加管理员";
$this->params['breadcrumbs'][] = ['label'=>'管理员','url'=>['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsuser-create">
    <h1><?= \yii\helpers\Html::encode($this->title);?></h1>
    <?=$this->render('_form',[
        'model'=>$model,
    ]);?>
</div>
