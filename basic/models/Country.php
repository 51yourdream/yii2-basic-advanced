<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/29
 * Time: 9:31
 */

namespace app\models;


use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    //返回当前数据表的名字
    // 如果类名和数据表名不能直接对应，可以覆写 yii\db\ActiveRecord::tableName() 方法去显式指定相关表名。
    public static function tableName() {
        //parent::tableName();
        return 'country';//这样写可以省略前缀
    }
}