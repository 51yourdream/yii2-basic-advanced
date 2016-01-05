表单有关

在 Yii 中使用表单的主要方式是通过 yii\widgets\ActiveForm。如果是基于模型的表单应首选这种方式。

此外，在 yii\helpers\Html 中也有一些实用的方法用于添加按钮和帮助文本。


yii\helpers\Html    添加按钮和帮助文档
yii\widgets\ActiveForm  小部件显示表单

 yii\widgets\ActiveForm->dropdownList(); //可以创建下拉列表

表单输入验证

在控制器中 可以使用 yii\base\Model::validate() 方法验证表单提交的数据 返回bool值

如果验证没有通过 可以通过  yii\base\Model::errors 属性获取响应的报错信息 返回错误信息组成的数组

$model = new \app\models\ContactForm;

// 用用户输入来填充模型的特性
$model->attributes = \Yii::$app->request->post('ContactForm');

if ($model->validate()) { //验证
// 若所有输入都是有效的
} else {
// 有效性验证失败：$errors 属性就是存储错误信息的数组
$errors = $model->errors;
}

在model中定义验证规则

public function rules()
{
    return [
        // name，email，subject 和 body 特性是 `require`（必填）的
        [['name', 'email', 'subject', 'body'], 'required'],

        // email 特性必须是一个有效的 email 地址
        ['email', 'email'],
    ];
}

yii\base\Model::rules() 方法应返回一个由规则所组成的数组，每一个规则都呈现为以下这类格式的小数组：

<?php
    [
        // 必须项，用于指定那些模型特性需要通过此规则的验证。
        // 对于只有一个特性的情况，可以直接写特性名，而不必用数组包裹。
        ['attribute1', 'attribute2', ...],

        // 必填项，用于指定规则的类型。
        // 它可以是类名，验证器昵称，或者是验证方法的名称。
        'validator', //验证器

        // 可选项，用于指定在场景（scenario）中，需要启用该规则
        // 若不提供，则代表该规则适用于所有场景
        // 若你需要提供除了某些特定场景以外的所有其他场景，你也可以配置 "except" 选项
        'on' => ['scenario1', 'scenario2', ...],

        // 可选项，用于指定对该验证器对象的其他配置选项
        'property1' => 'value1', 'property2' => 'value2', ...
    ]
?>
validator  验证器有哪些?
分三种
核心验证器：required in date
模型类中的某个验证方法名字或匿名方法
验证器类名称

在声明验证规则的时候也可以 同时制定验证错误信息
public function rules()
{
return [
['username', 'required', 'message' => '请填写验证规则'],
];
}

