<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/28
 * Time: 17:36
 */
use yii\helpers\Html;

$this->title ="About";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::encode($message) ?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
