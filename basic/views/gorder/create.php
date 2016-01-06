<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = '添加订单';
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
