<?php

namespace app\models;

use Yii;


class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() //yii\base\Model::attributeLabels() 方法明确指定属性标签
    {
        return [
            'id' => 'ID',
            'uid' => '用户ID',
            'gordernumber' => '订单号',
            'gototal' => '订单总价',
            'create_time' => '下单时间',
            'pay_time' => '支付时间',
            'finish_time' => '交易完成时间',
            'address' => '收获地址',
            'gostatus' => '订单状态',
        ];
    }
}
