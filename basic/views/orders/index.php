<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5>该列表暂时还未实现 联查功能</h5>
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
            'uid',
            'gordernumber',
            'gototal',
            [
                'value' => function ($data) {
                    return Yii::$app->formatter->asDate($data->create_time, 'yyyy-MM-dd'); // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
                'attribute'=>'create_time'
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDate($data->pay_time, 'yyyy-MM-dd'); // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
                'attribute'=>'pay_time'
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
                'value'=>function($data){
                    switch($data->gostatus){
                        case 0:
                            return '待付款';
                            break;
                        case 1:
                            return '待发货';
                            break;
                        case 2:
                            return '待收货';
                            break;
                        case 3:
                            return '待用户评论';
                            break;
                        case 4:
                            return '待商家评论';
                            break;
                        case 5:
                            return '交易完成';
                            break;
                        case 6:
                            return '无效订单';
                            break;
                    }
                }
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


</div>

<script>
//    用户可点击复选框来选择网格中的一些行。被选择的行可通过调用下面的JavaScript代码来获得：

    var keys = $('#grid').yiiGridView('getSelectedRows');  //为什么提示 $不存在
    // keys 为一个由与被选行相关联的键组成的数组
</script>
