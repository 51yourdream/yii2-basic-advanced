<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/28
 * Time: 18:12
 */

namespace app\models;


use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $password; //密码
    public $password2; //确认密码
    public function rules(){
        return [
            [['name','email'],'required','message'=>'不能为空'],
            ['name','required','message'=>'名称不能为空'],
            ['email','required','message'=>'邮箱不能为空'],
//            ['password','required','message'=>'密码不能为空'],
//            ['password2','compare','compareAttribute'=>'password','message'=>'两次密码不一致']
        ];
    }
}