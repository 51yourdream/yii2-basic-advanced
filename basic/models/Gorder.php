<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


class Gorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Gorder}}';
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
    public function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'uid']);
    }
    /**
     * 将栏目组合成key-value形式
     */
    public static  function  get_gostatus(){
        $cat = [
            ['id'=>0,'name'=>'待付款'],
            ['id'=>1,'name'=>'待发货'],
            ['id'=>2,'name'=>'待收货'],
        ];
        $cat = ArrayHelper::map($cat, 'id','name');
        return $cat;
    }

    /**
     * 通过栏目id获得栏目名称
     * @param unknown $id
     * @return Ambigous <unknown>
     */

    public static  function  get_gostatus1($id){
        $datas = [
            ['id'=>0,'name'=>'待付款'],
            ['id'=>1,'name'=>'待发货'],
            ['id'=>2,'name'=>'待收货'],
        ];
        $datas = ArrayHelper::map($datas, 'id', 'name');
        return  $datas[$id];

    }
}
