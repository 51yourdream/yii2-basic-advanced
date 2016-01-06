<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->gordernumber;
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'gordernumber',
            'gototal',
            [
                'label'=>'总价',
                'value'=>Yii::$app->formatter->asCurrency($model->gototal),
            ],
            'create_time:datetime',
            [
                'label'=>'下单时间',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ],
            [
                'label'=>'下单时间',
                'value'=>Yii::$app->formatter->asDate($model->create_time,'yyyy-MM-dd'),
            ],
            'address',
            'telephone'
        ],
    ]) ?>

</div>
