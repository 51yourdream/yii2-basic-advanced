<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], //序号咧

            'id',
            'telephone',
            'email:email',
            'password',
            'create_time',
            // 'user_type',
            // 'equipment_id',
            // 'login_time',
            // 'client_type',
            // 'token',

            [
                'class' => 'yii\grid\ActionColumn', //yii\grid\ActionColumn 用于显示一些动作按钮，如每一行的更新、删除操作。
                'controller'=>'My', //自定义控制器
                'template'=>"{view}{update}{delete}", //查看修改删除按钮
                'buttons'=>[
                    'view'=>function($url, $model, $key){
                        return '<a class="btn btn-info" href="'.$url.'">查看'.$key.'</a>';
                    }
                ],
            ], //动作列用于显示一系列动作
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                // 你可以在这配置更多的属性
            ],
            ['class' => 'yii\grid\SerialColumn'], // 序号列

            'id',
            'telephone',
            'email:email',
            'password',
            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'value' => function ($data) {
                    return Yii::$app->formatter->asDate($data->create_time, 'yyyy-MM-dd'); // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
                'attribute'=>'create_time',
                'footer'=>'注册时间',
                'visible'=>true,
                'content'=>function($model, $key, $index, $column){
                return 'w121';
            },
            ],
            // 'user_type',
            // 'equipment_id',
            // 'login_time',
            // 'client_type',
            // 'token',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'My', //自定义控制器
                'template'=>"{view}{update}{delete}", //查看修改删除按钮
                'buttons'=>[
                    'view'=>function($url, $model, $key){
                        return '<a class="btn btn-info" href="'.$url.'">查看'.$key.'</a>';
                    }
                ],
                'header'=>'操作',
            ], //动作列用于显示一系列动作
        ],
    ]); ?>
</div>
<script>
//    用户可点击复选框来选择网格中的一些行。被选择的行可通过调用下面的JavaScript代码来获得：

    var keys = $('#grid').yiiGridView('getSelectedRows');  //为什么提示 $不存在
    // keys 为一个由与被选行相关联的键组成的数组
</script>
