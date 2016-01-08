<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/8
 * Time: 18:22
 */
$this->title="登陆";
//$this->parmas['breadcrumbs'][]=$this->title;
?>
<div class="newuser-form">
    <?php $form = \yii\widgets\ActiveForm::begin();?>
    <?=$form->field($model,'username')->label('用户名');?>
    <?=$form->field($model,'password')->passwordInput()->label('密码');?>
    <?=\yii\helpers\Html::submitButton('登陆',['class'=>'btn btn-success']);?>
    <?php \yii\widgets\ActiveForm::end();?>
</div>
