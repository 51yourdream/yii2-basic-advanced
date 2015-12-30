<?php
1.控制器
=====================================================================
2.模型
=========================================================================
3.视图
    视图中引入组件
    use yii\helpers\Html;
    use yii\widgets\ActiveForm; 表单组件

/* @var $this yii\web\View */  默认的web/view 视图组件
/* @var $form yii\widgets\ActiveForm */ 表单组件
/* @var $model app\models\LoginForm */ 后台扔过来的models

$this->title = 'Login'; //网页标题赋值
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::submitButton('Login') ?>
<?php ActiveForm::end(); ?>

先调用 yii\helpers\Html::encode() 进行转码 防止跨站脚本攻击
要显示HTML内容，先调用 yii\helpers\HtmlPurifier 过滤内容，例如如下代码将提交内容在显示前先过滤：
<?php
use yii\helpers\HtmlPurifier;
?>
<?= HtmlPurifier::process($post->text) ?>

在 控制器 中，可调用以下控制器方法来渲染视图：

yii\base\Controller::render(): 渲染一个 视图名 并使用一个 布局 返回到渲染结果。
yii\base\Controller::renderPartial(): 渲染一个 视图名 并且不使用布局。
yii\web\Controller::renderAjax(): 渲染一个 视图名 并且不使用布局， 并注入所有注册的JS/CSS脚本和文件，通常使用在响应AJAX网页请求的情况下。
yii\base\Controller::renderFile(): 渲染一个视图文件目录或别名下的视图文件。

小部件中渲染

在 小部件 中，可调用以下小部件方法来渲染视图： Within widgets, you may call the following widget methods to render views.

yii\base\Widget::render(): 渲染一个 视图名.
yii\base\Widget::renderFile(): 渲染一个视图文件目录或别名下的视图文件。

例如：
<?php
    namespace app\components;

    use yii\base\Widget;
    use yii\helpers\Html;

    class ListWidget extends Widget //小部件
        {
            public $items = [];

            public function run()
            {
            // 渲染一个名为 "list" 的视图
            return $this->render('list', [
            'items' => $this->items,
            ]);
            }
        }
?>

视图中渲染

可以在视图中渲染另一个视图，可以调用yii\base\View视图组件提供的以下方法：

yii\base\View::render(): 渲染一个 视图名.
yii\web\View::renderAjax(): 渲染一个 视图名 并注入所有注册的JS/CSS脚本和文件，通常使用在响应AJAX网页请求的情况下。
yii\base\View::renderFile(): 渲染一个视图文件目录或别名下的视图文件。

例如，视图中的如下代码会渲染该视图所在目录下的 _overview.php 视图文件， 记住视图中 $this 对应 yii\base\View 组件:

<?= $this->render('_overview') ?>

其他地方渲染

在任何地方都可以通过表达式 Yii::$app->view 访问 yii\base\View 应用组件， 调用它的如前所述的方法渲染视图，例如：

// 显示视图文件 "@app/views/site/license.php"
echo \Yii::$app->view->renderFile('@app/views/site/license.php');

在视图中可以使用
The controller ID is: <?= $this->context->id ?> 获取当前视图的控制器id

=============================================================================
布局中各参数的含义

布局生成每个页面通用的HTML标签，在<body>标签中，打印$content变量， $content变量代表当yii\base\Controller::render()控制器渲染方法调用时传递到布局的内容视图渲染结果。

大多数视图应调用上述代码中的如下方法，这些方法触发关于渲染过程的事件， 这样其他地方注册的脚本和标签会添加到这些方法调用的地方。

yii\base\View::beginPage(): 该方法应在布局的开始处调用， 它触发表明页面开始的 yii\base\View::EVENT_BEGIN_PAGE 事件。
yii\base\View::endPage(): 该方法应在布局的结尾处调用， 它触发表明页面结尾的 yii\base\View::EVENT_END_PAGE 时间。
yii\web\View::head(): 该方法应在HTML页面的<head>标签中调用， 它生成一个占位符，在页面渲染结束时会被注册的头部HTML代码（如，link标签, meta标签）替换。
    yii\web\View::beginBody(): 该方法应在<body>标签的开始处调用， 它触发 yii\web\View::EVENT_BEGIN_BODY 事件并生成一个占位符， 会被注册的HTML代码（如JavaScript）在页面主体开始处替换。
yii\web\View::endBody(): 该方法应在<body>标签的结尾处调用， 它触发 yii\web\View::EVENT_END_BODY 事件并生成一个占位符， 会被注册的HTML代码（如JavaScript）在页面主体结尾处替换。
====================================================================

布局文件
控制器中默认布局文件是 views/layout/main.php 文件
可以在控制器中定义 加载哪个布局文件 views/layout/post.php
<?php
    class PostController extends Controller
    {
    public $layout = 'post';

    // ...
    }
?>
================================================================================
嵌套布局

有时候你想嵌套一个布局到另一个，例如，在Web站点不同地方，想使用不同的布局， 同时这些布局共享相同的生成全局HTML5页面结构的基本布局，可以在子布局中调用 yii\base\View::beginContent() 和yii\base\View::endContent() 方法，如下所示：

<?php $this->beginContent('@app/views/layouts/base.php'); ?>

...child layout content here...

<?php $this->endContent(); ?>

如上所示，子布局内容应在 yii\base\View::beginContent() 和 yii\base\View::endContent() 方法之间，传给 yii\base\View::beginContent() 的参数指定父布局，父布局可为布局文件或别名。

使用以上方式可多层嵌套布局。
===================================================================================

使用数据块
view/layout/main.php 是布局视图

view/site/视图文件 是内容视图

======================================================================================
数据块可以在一个地方指定视图内容在另一个地方显示，通常和布局一起使用， 例如，可在内容视图中定义数据块在布局中显示它。

调用 yii\base\View::beginBlock() 和 yii\base\View::endBlock() 来定义数据块， 使用 $view->blocks[$blockID] 访问该数据块，其中 $blockID 为定义数据块时指定的唯一标识ID。

如下实例显示如何在内容视图中使用数据块让布局使用。

首先，在内容视图中定一个或多个数据块：

...

<?php $this->beginBlock('block1'); ?>

...content of block1...

<?php $this->endBlock(); ?>

...

<?php $this->beginBlock('block3'); ?>

...content of block3...

<?php $this->endBlock(); ?>

然后，在布局视图中，数据块可用的话会渲染数据块，如果数据未定义则显示一些默认内容。

...
<?php if (isset($this->blocks['block1'])): ?>
    <?= $this->blocks['block1'] ?>
<?php else: ?>
    ... default content for block1 ...
<?php endif; ?>

...

<?php if (isset($this->blocks['block2'])): ?>
    <?= $this->blocks['block2'] ?>
<?php else: ?>
    ... default content for block2 ...
<?php endif; ?>

...

<?php if (isset($this->blocks['block3'])): ?>
    <?= $this->blocks['block3'] ?>
<?php else: ?>
    ... default content for block3 ...
<?php endif; ?>

===================================================================================================
设置页面标题

每个Web页面应有一个标题，正常情况下标题的标签显示在 布局中， 但是实际上标题大多由内容视图而不是布局来决定，为解决这个问题， yii\web\View 提供 yii\web\View::title 标题属性可让标题信息从内容视图传递到布局中。

为利用这个特性，在每个内容视图中设置页面标题，如下所示：

<?php
$this->title = 'My page title';
?>

然后在视图中，确保在 <head> 段中有如下代码：

    <title><?= Html::encode($this->title) ?></title>
=====================================================================================================
    注册Meta元标签

    Web页面通常需要生成各种元标签提供给不同的浏览器，如<head>中的页面标题，元标签通常在布局中生成。

        如果想在内容视图中生成元标签，可在内容视图中调用yii\web\View::registerMetaTag()方法，如下所示：

        <?php
        $this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, framework, php']);
        ?>

        以上代码会在视图组件中注册一个 "keywords" 元标签，在布局渲染后会渲染该注册的元标签， 然后，如下HTML代码会插入到布局中调用yii\web\View::head()方法处：

        <meta name="keywords" content="yii, framework, php">

        注意如果多次调用 yii\web\View::registerMetaTag() 方法，它会注册多个元标签，注册时不会检查是否重复。

        为确保每种元标签只有一个，可在调用方法时指定键作为第二个参数， 例如，如下代码注册两次 "description" 元标签，但是只会渲染第二个。

        $this->registerMetaTag(['name' => 'description', 'content' => 'This is my cool website made with Yii!'], 'description');
        $this->registerMetaTag(['name' => 'description', 'content' => 'This website is about funny raccoons.'], 'description');
==============================================================

        注册链接标签

        和 Meta标签 类似，链接标签有时很实用，如自定义网站图标，指定Rss订阅，或授权OpenID到其他服务器。 可以和元标签相似的方式调用yii\web\View::registerLinkTag()，例如，在内容视图中注册链接标签如下所示：

        $this->registerLinkTag([
        'title' => 'Live News for Yii',
        'rel' => 'alternate',
        'type' => 'application/rss+xml',
        'href' => 'http://www.yiiframework.com/rss.xml/',
        ]);

        上述代码会转换成

        <link title="Live News for Yii" rel="alternate" type="application/rss+xml" href="http://www.yiiframework.com/rss.xml/">

        和 yii\web\View::registerMetaTag() 类似， 调用yii\web\View::registerLinkTag() 指定键来避免生成重复链接标签。
========================================================================================================
<!--模块-->

<!--过滤器-->
