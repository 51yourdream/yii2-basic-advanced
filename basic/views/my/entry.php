<style>
    div.required label:after {
        content: " *";
        color: red;
    }
</style>
<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/28
 * Time: 18:25
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id'=>'login-form',
    'options'=>['class'=>'form-horizontal'],
    'action'=>'#'
]);?>
<?= $form->field($model,'name');?>
<?= $form->field($model,'password')->passwordInput()->hint('请输入密码')->label('密码'); ?>
<?= $form->field($model,'file[]')->fileInput(['multiple'=>'multiple']);?>
<?= $form->field($model, 'items[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);?>
<?= $form->field($model,'country')->dropdownList(
    \app\models\Country::find()->select('name','name')->indexBy('population')->column(),
    ['prompt'=>'--请选择--']
); ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
<?php
$form = ActiveForm::begin([
    'id'=>'login-form1',
    'action'=>'#'
]);?>
<?= $form->field($model,'name');?>
<?= $form->field($model,'password')->passwordInput()->hint('请输入密码')->label('密码'); ?>
<?= $form->field($model,'file[]')->fileInput(['multiple'=>'multiple']);?>
<?= $form->field($model, 'items[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);?>
<?= $form->field($model,'country')->dropdownList(
    \app\models\Country::find()->select('name','name')->indexBy('population')->column(),
    ['prompt'=>'--请选择--']
); ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        <?= Html::Button('重置', ['class' => 'btn btn-info']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
