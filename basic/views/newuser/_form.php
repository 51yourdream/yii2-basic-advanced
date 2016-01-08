<div class="newuser-form">
    <?php $form = \yii\widgets\ActiveForm::begin();?>
    <?= $form->field($model,'username')->label('用户名');?>
    <?= $form->field($model,'email')->label('邮箱');?>
    <?= $form->field($model,'password')->passwordInput()->label('密码');?>
    <?= $form->field($model,'repassword')->passwordInput()->label('确认密码');?>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= \yii\bootstrap\Html::submitButton($model->isNewRecord ? '添加': '修改',['class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
        <?= \yii\bootstrap\Html::resetButton('重置',['class'=>"btn btn-default"]);?>
    </div>
    <?php \yii\widgets\ActiveForm::end();?>
</div>