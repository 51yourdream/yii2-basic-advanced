<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $id
 * @property string $telephone
 * @property string $email
 * @property string $password
 * @property string $create_time
 * @property integer $user_type
 * @property string $equipment_id
 * @property string $login_time
 * @property string $client_type
 * @property string $token
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    //场景设置不起作用
    public function scenarios()
    {
        return [
            'login' => ['telephone', 'password'],
            'register' => ['telephone', 'email', 'password'],
        ];
    }

    public function fields(){
        $fields = parent::fields();
        error_log(print_r($fields,1));
        unset($fields['password']);
        return $fields;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telephone', 'password', 'create_time', 'user_type', 'equipment_id', 'client_type'], 'required','on'=>'register'], //用on来指定 验证规则在指定场景下使用
            [['user_type'], 'integer'],
            [['telephone', 'create_time', 'login_time'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 30],
            [['password', 'token'], 'string', 'max' => 32],
            [['equipment_id'], 'string', 'max' => 50],
            [['client_type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() //yii\base\Model::attributeLabels() 方法明确指定属性标签
    {
        return [
            'id' => 'ID',
            'telephone' => '电话',
            'email' => '邮箱',
            'password' => '密码',
            'create_time' => '注册时间',
            'user_type' => '用户类型',
            'equipment_id' => '设备号',
            'login_time' => '最后一次登录时间',
            'client_type' => '客户端类型',
            'token' => 'Token',
        ];
    }
//应用支持多语言的情况下，可翻译属性标签， 可在 yii\base\Model::attributeLabels() 方法中定义，如下所示:
//    public function attributeLabels()
//    {
//        return [
//            'name' => \Yii::t('app', 'Your name'),
//            'email' => \Yii::t('app', 'Your email address'),
//            'subject' => \Yii::t('app', 'Subject'),
//            'body' => \Yii::t('app', 'Content'),
//        ];
//    }
}
