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
    public $repassword;
    public $isGuest;
    public static function tableName(){
        return '{{%newuser}}';
    }
    public function scenarios(){
        return [
            'create'=>['username','email','password','repassword'],
            'update'=>['username','email','password'],
        ];
    }
    public function rules(){
        return [
            [['username','email'],'required','on'=>['create','update']],
            ['password,repassword','required','on'=>'create'],
            ['username','match','pattern'=>'/^[a-z0-9_-]{6,12}$/','message'=>'用户名6-12字母数字下划线组成','on'=>'create'],
            ['username','unique','message'=>'该用户名已经注册过了','on'=>'create'],// unique不起作用
            ['email','email','message'=>'请输入有效的邮箱','on'=>'create'],
            ['email','unique','message'=>'该邮箱已经注册过了','on'=>'create'],
            ['password','match','pattern'=>'/[a-z0-9_-]{6,12}$/','message'=>'请输入6-12字母数字下划线组成','on'=>['create','update']],
            ['repassword','compare','compareAttribute'=>'password','message'=>'请再次输入密码','on'=>'create']
//             ['email','unique','message'=>'该邮箱已经注册过了']
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            foreach($this as $k=>$v){
                if($v){
                    $this->$k = trim($v);
                }
            }
            //$this->isNewRecord 可以判断是添加 还是修改操作
            if($this->isNewRecord || ($this->isNewRecord && $this->password)){
                $this->password=md5(trim($this->password));
                $this->create_time=time();
            }else{
                if($this->password){
                    $this->password=md5(trim($this->password));
                    $this->updated_time=time();
                }
            }
            return true;
        }else{
            return false;
        }
    }

    public static function findByUsername($username,$password){
        return static::findOne(['username'=>$username,'password'=>$password]);
    }
    public static function encryptPassword($password){
        return md5(trim($password));
    }

}