<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/7
 * Time: 13:28
 */

namespace app\models\newuser;

use Yii;
use yii\db\ActiveRecord;

class Newuser extends ActiveRecord
{
    public static function tableName(){
        return '{{%newuser}}';
    }

}