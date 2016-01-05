<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/5
 * Time: 15:09
 */

namespace app\models;
use yii\base\Model;

class MyForm extends Model
{
    public $country;
    public $token;

    public function rules()
    {
        return [
            // 以模型方法 validateCountry() 形式定义的行内验证器
            ['country', 'validateCountry'],

            // 以匿名函数形式定义的行内验证器
            ['token', function ($attribute, $params) {
                if (!ctype_alnum($this->$attribute)) {
                    $this->addError($attribute, 'token 本身必须包含字母或数字。');
                }
            }],
        ];
    }

    public function validateCountry($attribute, $params)
    {
        if (!in_array($this->$attribute, ['USA', 'Web'])) {
            $this->addError($attribute, 'The country must be either "USA" or "Web".');
        }
    }
}