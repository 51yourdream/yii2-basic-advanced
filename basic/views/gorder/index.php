<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5>该列联查功能</h5>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加订单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], //序号咧
            'id',
            [
                'attribute'=>'uid',
                "filter"=>[1,2,3,4,5],
            ],
            'gordernumber',
            'gototal',
            'users.telephone',
            'users.id',
            'users.email',
            'users.create_time',
            [
                'value' => function ($data) {
                    return Yii::$app->formatter->asDate($data->create_time, 'yyyy-MM-dd'); // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
                'attribute'=>'create_time'
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'value' =>
                    function ($data) {
                        if($data->pay_time){
                            return  date('Y-m-d H:i:s',$data->pay_time);// 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                        }
                },
                'filterInputOptions'=>Html::addCssStyle('pay_time',['width','170px']),//这个设置不起作用
                'attribute'=>'pay_time',
                'filter'=> DatePicker::widget([
                    'language' => 'zh-CN',
                    'name' => 'pay_time',
                    'value' =>'',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'value' => function ($data) {
                    if($data->finish_time) {
                        return $data->finish_time;
//                        return Yii::$app->formatter->asDate($data->finish_time, 'yyyy-MM-dd'); // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                    }else{
                        return '交易进行中';
                    }
                },
                'attribute'=>'finish_time'
            ],
            'address',
            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'attribute'=>'gostatus',
                'label'=>'订单状态',
                'value'=>
                    function($model){
                        return \app\models\Gorder::get_gostatus1($model->gostatus);
                    },
                'filter'=>\app\models\Gorder::get_gostatus(),
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'controller'=>'my',
                'template'=>'{view}',
                'header'=>'查看订单详情'
            ],
            [
                'class' => 'yii\grid\ActionColumn', //yii\grid\ActionColumn 用于显示一些动作按钮，如每一行的更新、删除操作。
                'header'=>'操作'
            ], //动作列用于显示一系列动作
        ],
    ]); ?>

<?=  DatePicker::widget([
    'name' => '',
    'value' =>'',
    'template' => '{addon}{input}',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd'
    ]
]);?>
</div>

<script>
//    用户可点击复选框来选择网格中的一些行。被选择的行可通过调用下面的JavaScript代码来获得：

    var keys = $('#grid').yiiGridView('getSelectedRows');  //为什么提示 $不存在
    // keys 为一个由与被选行相关联的键组成的数组
</script>
