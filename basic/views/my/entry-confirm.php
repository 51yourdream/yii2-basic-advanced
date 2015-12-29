<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/28
 * Time: 18:24
 */
use yii\helpers\Html;
?>
<p>
    你输入了以下信息:
</p>
<ul>
    <li><label for="">Name</label>:<?= Html::encode($model->name) ?></li>
    <li><label for="">Email</label>:<?= Html::encode($model->email) ?></li>
</ul>
