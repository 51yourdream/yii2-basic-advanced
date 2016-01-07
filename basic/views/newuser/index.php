<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 13:57
 */
$this->title = '新建newuser表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="newuser-index">
    <h1><?= \yii\helpers\Html::encode($this->title);?></h1>
    <p>
        <?= \yii\helpers\Html::a('添加用户',['create'],['class'=>'btn btn-success']);?>
    </p>

    <?=\yii\grid\GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$newuserModel,
        'columns'=>[
            'id',
            'username',
            'email',
            'role',
            'status',
            'create_time',
            'updated_time',
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'操作'
            ]
        ],
    ]); ?>
</div>
