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
 ======================================================================
<!--前端资源 Assets-->
        <?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    //  web/css/demo.css
    //  web/js/demo.js 下方公共 css js文件
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
?>
例如，只想IE9或更高的浏览器包含一个CSS文件，可以使用如下选项：

public $cssOptions = ['condition' => 'lte IE9'];
这会是包中的CSS文件使用以下HTML标签包含进来：

<!--[if lte IE9]>
<link rel="stylesheet" href="path/to/foo.css">
<![endif]-->

为链接标签包含<noscript>可使用如下代码：

    public $cssOptions = ['noscript' => true];
    为使JavaScript文件包含在页面head区域（JavaScript文件默认包含在body的结束处）使用以下选项：

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];


<!--扩展 (Extensions)-->


<!--运行概述 Overview-->

<!-- 路由引导创建 URL(Routing and URL Creation)-->

<!--请求(Request)-->
请求

一个应用的请求是用 yii\web\Request 对象来表示的，该对象提供了诸如 请求参数（译者注：通常是GET参数或者POST参数）、HTTP头、cookies等信息。 默认情况下，对于一个给定的请求，你可以通过 request application component 应用组件（yii\web\Request 类的实例） 获得访问相应的请求对象。在本章节，我们将介绍怎样在你的应用中使用这个组件。

请求参数

要获取请求参数，你可以调用 request 组件的 yii\web\Request::get() 方法和 yii\web\Request::post() 方法。 他们分别返回 $_GET 和 $_POST 的值。例如，
<?php
$request = Yii::$app->request;

$get = $request->get();
// 等价于: $get = $_GET;

$id = $request->get('id');
// 等价于: $id = isset($_GET['id']) ? $_GET['id'] : null;

$id = $request->get('id', 1);
// 等价于: $id = isset($_GET['id']) ? $_GET['id'] : 1;

$post = $request->post();
// 等价于: $post = $_POST;

$name = $request->post('name');
// 等价于: $name = isset($_POST['name']) ? $_POST['name'] : null;

$name = $request->post('name', '');
// 等价于: $name = isset($_POST['name']) ? $_POST['name'] : '';
?>
信息：建议你像上面那样通过 request 组件来获取请求参数，而不是 直接访问 $_GET 和 $_POST。 这使你更容易编写测试用例，因为你可以伪造数据来创建一个模拟请求组件。

当实现 RESTful APIs 接口的时候，你经常需要获取通过PUT， PATCH或者其他的 request methods 请求方法提交上来的参数。你可以通过调用 yii\web\Request::getBodyParam() 方法来获取这些参数。例如，
<?php
$request = Yii::$app->request;

// 返回所有参数
$params = $request->bodyParams;

// 返回参数 "id"
$param = $request->getBodyParam('id');
?>
信息：不同于 GET 参数，POST，PUT，PATCH 等等这些提交上来的参数是在请求体中被发送的。 当你通过上面介绍的方法访问这些参数的时候，request 组件会解析这些参数。 你可以通过配置 yii\web\Request::parsers 属性来自定义怎样解析这些参数。


请求方法

你可以通过 Yii::$app->request->method 表达式来获取当前请求使用的HTTP方法。 这里还提供了一整套布尔属性用于检测当前请求是某种类型。 例如，
<?php
$request = Yii::$app->request;

if ($request->isAjax) { /* 该请求是一个 AJAX 请求 */ }
if ($request->isGet)  { /* 请求方法是 GET */ }
if ($request->isPost) { /* 请求方法是 POST */ }
if ($request->isPut)  { /* 请求方法是 PUT */ }
?>

请求URLs

request 组件提供了许多方式来检测当前请求的URL。

假设被请求的URL是 http://example.com/admin/index.php/product?id=100， 你可以像下面描述的那样获取URL的各个部分：

yii\web\Request::url：返回 /admin/index.php/product?id=100, 此URL不包括host info部分。
yii\web\Request::absoluteUrl：返回 http://example.com/admin/index.php/product?id=100, 包含host infode的整个URL。
yii\web\Request::hostInfo：返回 http://example.com, 只有host info部分。
yii\web\Request::pathInfo：返回 /product， 这个是入口脚本之后，问号之前（查询字符串）的部分。
yii\web\Request::queryString：返回 id=100,问号之后的部分。
yii\web\Request::baseUrl：返回 /admin, host info之后， 入口脚本之前的部分。
yii\web\Request::scriptUrl：返回 /admin/index.php, 没有path info和查询字符串部分。
yii\web\Request::serverName：返回 example.com, URL中的host name。
yii\web\Request::serverPort：返回 80, 这是web服务中使用的端口。

HTTP头

你可以通过 yii\web\Request::headers 属性返回的 yii\web\HeaderCollection 获取HTTP头信息。 例如，
<?php
// $headers 是一个 yii\web\HeaderCollection 对象
$headers = Yii::$app->request->headers;

// 返回 Accept header 值
$accept = $headers->get('Accept');

if ($headers->has('User-Agent')) { /* 这是一个 User-Agent 头 */ }
?>
请求组件也提供了支持快速访问常用头的方法，包括：

yii\web\Request::userAgent：返回 User-Agent 头。
yii\web\Request::contentType：返回 Content-Type 头的值， Content-Type 是请求体中MIME类型数据。
yii\web\Request::acceptableContentTypes：返回用户可接受的内容MIME类型。 返回的类型是按照他们的质量得分来排序的。得分最高的类型将被最先返回。
yii\web\Request::acceptableLanguages：返回用户可接受的语言。 返回的语言是按照他们的偏好层次来排序的。第一个参数代表最优先的语言。
假如你的应用支持多语言，并且你想在终端用户最喜欢的语言中显示页面，那么你可以使用语言协商方法 yii\web\Request::getPreferredLanguage()。 这个方法通过 yii\web\Request::acceptableLanguages 在你的应用中所支持的语言列表里进行比较筛选，返回最适合的语言。

提示：你也可以使用 yii\filters\ContentNegotiator 过滤器进行动态确定哪些内容类型和语言应该在响应中使用。 这个过滤器实现了上面介绍的内容协商的属性和方法。

客户端信息

你可以通过 yii\web\Request::userHost 和 yii\web\Request::userIP 分别获取host name和客户机的IP地址， 例如，

$userHost = Yii::$app->request->userHost;
$userIP = Yii::$app->request->userIP;

<!--响应(Responses)-->
响应

当应用完成处理一个请求后, 会生成一个yii\web\Response响应对象并发送给终端用户 响应对象包含的信息有HTTP状态码，HTTP头和主体内容等, 网页应用开发的最终目的本质上就是根据不同的请求构建这些响应对象。

在大多是情况下主要处理继承自 yii\web\Response 的 response 应用组件， 尽管如此，Yii也允许你创建你自己的响应对象并发送给终端用户，这方面后续会阐述。

在本节，将会描述如何构建响应和发送给终端用户。

状态码

构建响应时，最先应做的是标识请求是否成功处理的状态，可通过设置 yii\web\Response::statusCode 属性，该属性使用一个有效的 HTTP 状态码。例如，为标识处理已被处理成功， 可设置状态码为200，如下所示：
<?php
Yii::$app->response->statusCode = 200;
?>
尽管如此，大多数情况下不需要明确设置状态码，因为 yii\web\Response::statusCode 状态码默认为200， 如果需要指定请求失败，可抛出对应的HTTP异常，如下所示
<?php throw new \yii\web\NotFoundHttpException; ?>

当错误处理器 捕获到一个异常，会从异常中提取状态码并赋值到响应， 对于上述的 yii\web\NotFoundHttpException 对应HTTP 404状态码，以下为Yii预定义的HTTP异常：

yii\web\BadRequestHttpException: status code 400.
yii\web\ConflictHttpException: status code 409.
yii\web\ForbiddenHttpException: status code 403.
yii\web\GoneHttpException: status code 410.
yii\web\MethodNotAllowedHttpException: status code 405.
yii\web\NotAcceptableHttpException: status code 406.
yii\web\NotFoundHttpException: status code 404.
yii\web\ServerErrorHttpException: status code 500.
yii\web\TooManyRequestsHttpException: status code 429.
yii\web\UnauthorizedHttpException: status code 401.
yii\web\UnsupportedMediaTypeHttpException: status code 415.
如如果想抛出的异常不在如上列表中，可创建一个yii\web\HttpException异常，带上状态码抛出，如下：

  <?php throw new \yii\web\HttpException(402); ?>

HTTP 头部

可在 response 组件中操控yii\web\Response::headers来发送HTTP头部信息，例如：
<?php
$headers = Yii::$app->response->headers;

// 增加一个 Pragma 头，已存在的Pragma 头不会被覆盖。
$headers->add('Pragma', 'no-cache');

// 设置一个Pragma 头. 任何已存在的Pragma 头都会被丢弃
$headers->set('Pragma', 'no-cache');

// 删除Pragma 头并返回删除的Pragma 头的值到数组
$values = $headers->remove('Pragma');
?>

补充: 头名称是大小写敏感的，在yii\web\Response::send()方法调用前新注册的头信息并不会发送给用户。

响应主体
大多是响应应有一个主体存放你想要显示给终端用户的内容。

如果已有格式化好的主体字符串，可赋值到响应的yii\web\Response::content属性，例如：
<?php Yii::$app->response->content = 'hello world!'; ?>

如果在发送给终端用户之前需要格式化，应设置 yii\web\Response::format 和 yii\web\Response::data 属性，yii\web\Response::format 属性指定yii\web\Response::data中数据格式化后的样式，例如：
<?php
$response = Yii::$app->response;
$response->format = \yii\web\Response::FORMAT_JSON;
$response->data = ['message' => 'hello world'];
?>
Yii支持以下可直接使用的格式，每个实现了yii\web\ResponseFormatterInterface 类，
可自定义这些格式器或通过配置yii\web\Response::formatters 属性来增加格式器。

yii\web\Response::FORMAT_HTML: 通过 yii\web\HtmlResponseFormatter 来实现.
yii\web\Response::FORMAT_XML: 通过 yii\web\XmlResponseFormatter来实现.
yii\web\Response::FORMAT_JSON: 通过 yii\web\JsonResponseFormatter来实现.
yii\web\Response::FORMAT_JSONP: 通过 yii\web\JsonResponseFormatter来实现.

上述响应主体可明确地被设置，但是在大多数情况下是通过 操作 方法的返回值隐式地设置，常用场景如下所示：
<?php
    public function actionIndex()
    {
        return $this->render('index');
    }
?>
上述的 index 操作返回 index 视图渲染结果，返回值会被 response 组件格式化后发送给终端用户。

因为响应格式默认为yii\web\Response::FORMAT_HTML, 只需要在操作方法中返回一个字符串， 如果想使用其他响应格式，应在返回数据前先设置格式，例如：

<?php
    public function actionInfo()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => 'hello world',
            'code' => 100,
        ];
    }
?>

如上所述，触雷使用默认的 response 应用组件，也可创建自己的响应对象并发送给终端用户，可在操作方法中返回该响应对象，如下所示：

<?php
    public function actionInfo()
    {
        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => 'hello world',
                'code' => 100,
            ],
        ]);
    }
?>
注意: 如果创建你自己的响应对象，将不能在应用配置中设置 response 组件，尽管如此， 可使用 依赖注入 应用通用配置到你新的响应对象。

<!--浏览器跳转-->
浏览器跳转依赖于发送一个Location HTTP 头，因为该功能通常被使用，Yii提供对它提供了特别的支持。

可调用yii\web\Response::redirect() 方法将用户浏览器跳转到一个URL地址，该方法设置合适的 带指定URL的 Location 头并返回它自己为响应对象，在操作的方法中，可调用缩写版yii\web\Controller::redirect()，例如：
<?php
    public function actionOld()
    {
        return $this->redirect('http://example.com/new', 301);
    }
?>
在如上代码中，操作的方法返回redirect() 方法的结果，如前所述，操作的方法返回的响应对象会被当总响应发送给终端用户。

除了操作方法外，可直接调用yii\web\Response::redirect() 再调用 yii\web\Response::send() 方法来确保没有其他内容追加到响应中。

<?php \Yii::$app->response->redirect('http://example.com/new', 301)->send();?>

补充: yii\web\Response::redirect() 方法默认会设置响应状态码为302，该状态码会告诉浏览器请求的资源 临时 放在另一个URI地址上，可传递一个301状态码告知浏览器请求的资源已经 永久 重定向到新的URId地址。

如果当前请求为AJAX 请求，发送一个 Location 头不会自动使浏览器跳转，为解决这个问题， yii\web\Response::redirect() 方法设置一个值为要跳转的URL的X-Redirect 头， 在客户端可编写JavaScript 代码读取该头部值然后让浏览器跳转对应的URL。

补充: Yii 配备了一个yii.js JavaScript 文件提供常用JavaScript功能，包括基于X-Redirect头的浏览器跳转， 因此，如果你使用该JavaScript 文件(通过yii\web\YiiAsset 资源包注册)，就不需要编写AJAX跳转的代码。

发送文件

和浏览器跳转类似，文件发送是另一个依赖指定HTTP头的功能，Yii提供方法集合来支持各种文件发送需求，它们对HTTP头都有内置的支持。

yii\web\Response::sendFile(): 发送一个已存在的文件到客户端
yii\web\Response::sendContentAsFile(): 发送一个文本字符串作为文件到客户端
yii\web\Response::sendStreamAsFile(): 发送一个已存在的文件流作为文件到客户端
这些方法都将响应对象作为返回值，如果要发送的文件非常大，应考虑使用 yii\web\Response::sendStreamAsFile() 因为它更节约内存，以下示例显示在控制器操作中如何发送文件：
<?php
public function actionDownload()
{
return \Yii::$app->response->sendFile('path/to/file.txt');
}
?>
如果不是在操作方法中调用文件发送方法，在后面还应调用 yii\web\Response::send() 没有其他内容追加到响应中。

\Yii::$app->response->sendFile('path/to/file.txt')->send();

一些浏览器提供特殊的名为X-Sendfile的文件发送功能，原理为将请求跳转到服务器上的文件， Web应用可在服务器发送文件前结束，为使用该功能，可调用yii\web\Response::xSendFile()， 如下简要列出一些常用Web服务器如何启用X-Sendfile 功能：

Apache: X-Sendfile
Lighttpd v1.4: X-LIGHTTPD-send-file
Lighttpd v1.5: X-Sendfile
Nginx: X-Accel-Redirect
Cherokee: X-Sendfile and X-Accel-Redirect


发送响应
在yii\web\Response::send() 方法调用前响应中的内容不会发送给用户，该方法默认在yii\base\Application::run() 结尾自动调用，尽管如此，可以明确调用该方法强制立即发送响应。

yii\web\Response::send() 方法使用以下步骤来发送响应：

触发 yii\web\Response::EVENT_BEFORE_SEND 事件.
调用 yii\web\Response::prepare() 来格式化 yii\web\Response::data 为 yii\web\Response::content.
触发 yii\web\Response::EVENT_AFTER_PREPARE 事件.
调用 yii\web\Response::sendHeaders() 来发送注册的HTTP头
调用 yii\web\Response::sendContent() 来发送响应主体内容
触发 yii\web\Response::EVENT_AFTER_SEND 事件.
一旦yii\web\Response::send() 方法被执行后，其他地方调用该方法会被忽略， 这意味着一旦响应发出后，就不能再追加其他内容。

如你所见yii\web\Response::send() 触发了几个实用的事件，通过响应这些事件可调整或包装响应。


Session and Cookies

Session 和请求响应类似 默认可通过为yii\web\Session 实例session 应用组件来访问session

  开启关闭session
<?php
   $session = Yii::$app->session; //获取session对象
   //检查session是否开启
    if($session->isActive){}
   //开启session
    $session->open();
   //关闭session
   $session->close();
   //销毁session中已经注册的数据
   $session->destroy();
 ?>
多次调用yii\web\Session::open() 和yii\web\Session::close() 方法并不会产生错误， 因为方法内部会先检查session是否已经开启。

可通过一下数据来访问session中的数据
<?php
$session = Yii::$app->session;
// 获取session中的变量值，以下用法是相同的：
$language = $session->get('language');
$language = $session['language'];
$language = isset($_SESSION['language']) ? $_SESSION['language'] : null;

// 设置一个session变量，以下用法是相同的：
$session->set('language', 'en-US');
$session['language'] = 'en-US';
$_SESSION['language'] = 'en-US';

// 检查session变量是否已存在，以下用法是相同的：
if ($session->has('language')) ...
if (isset($session['language'])) ...
if (isset($_SESSION['language'])) ...

// 遍历所有session变量，以下用法是相同的：
foreach ($session as $name => $value) ...
foreach ($_SESSION as $name => $value) ...

//补充: 当使用session组件访问session数据时候，如果session没有开启会自动开启， 这和通过$_SESSION不同，$_SESSION要求先执行session_start()。
//当session数据为数组时，session组件会限制你直接修改数据中的单元项，例如：
$session = Yii::$app->session;

// 如下代码不会生效
$session['captcha']['number'] = 5;
$session['captcha']['lifetime'] = 3600;

// 如下代码会生效：
$session['captcha'] = [
    'number' => 5,
    'lifetime' => 3600,
];

// 如下代码也会生效：
echo $session['captcha']['lifetime'];

//可使用以下任意一个变通方法来解决这个问题：

$session = Yii::$app->session;

// 直接使用$_SESSION (确保Yii::$app->session->open() 已经调用)
$_SESSION['captcha']['number'] = 5;
$_SESSION['captcha']['lifetime'] = 3600;

// 先获取session数据到一个数组，修改数组的值，然后保存数组到session中
$captcha = $session['captcha'];
$captcha['number'] = 5;
$captcha['lifetime'] = 3600;
$session['captcha'] = $captcha;

// 使用ArrayObject 数组对象代替数组
$session['captcha'] = new \ArrayObject;
...
$session['captcha']['number'] = 5;
$session['captcha']['lifetime'] = 3600;

// 使用带通用前缀的键来存储数组
$session['captcha.number'] = 5;
$session['captcha.lifetime'] = 3600;

//为更好的性能和可读性，推荐最后一种方案，也就是不用存储session变量为数组， 而是将每个数组项变成有相同键前缀的session变量。

自定义Session存储

yii\web\Session 类默认存储session数据为文件到服务器上，Yii提供以下session类实现不同的session存储方式：

yii\web\DbSession: 存储session数据在数据表中
yii\web\CacheSession: 存储session数据到缓存中，缓存和配置中的缓存组件相关
yii\redis\Session: 存储session数据到以redis 作为存储媒介中
yii\mongodb\Session: 存储session数据到MongoDB.
所有这些session类支持相同的API方法集，因此，切换到不同的session存储介质不需要修改项目使用session的代码。

注意: 如果通过$_SESSION访问使用自定义存储介质的session，需要确保session已经用yii\web\Session::open() 开启， 这是因为在该方法中注册自定义session存储处理器。

学习如何配置和使用这些组件类请参考它们的API文档，如下为一个示例 显示如何在应用配置中配置yii\web\DbSession将数据表作为session存储介质。

return [
    'components' => [
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // 数据库连接的应用组件ID，默认为'db'.
            // 'sessionTable' => 'my_session', // session 数据表名，默认为'session'.
        ],
    ],
];
也需要创建如下数据库表来存储session数据：

CREATE TABLE session
(
    id CHAR(40) NOT NULL PRIMARY KEY,
    expire INTEGER,
    data BLOB
)

其中'BLOB' 对应你选择的数据库管理系统的BLOB-type类型，以下一些常用数据库管理系统的BLOB类型：

MySQL: LONGBLOB
PostgreSQL: BYTEA
MSSQL: BLOB
注意: 根据php.ini 设置的 session.hash_function，你需要调整id列的长度， 例如，如果 session.hash_function=sha256 ，应使用长度为64而不是40的char类型。


Flash 数据

Flash数据是一种特别的session数据，它一旦在某个请求中设置后，只会在下次请求中有效，然后该数据就会自动被删除。 常用于实现只需显示给终端用户一次的信息，如用户提交一个表单后显示确认信息。

可通过session应用组件设置或访问session，例如：

$session = Yii::$app->session;

// 请求 #1
// 设置一个名为"postDeleted" flash 信息
$session->setFlash('postDeleted', 'You have successfully deleted your post.');

// 请求 #2
// 显示名为"postDeleted" flash 信息
echo $session->getFlash('postDeleted');

// 请求 #3
// $result 为 false，因为flash信息已被自动删除
$result = $session->hasFlash('postDeleted');
和普通session数据类似，可将任意数据存储为flash数据。

当调用yii\web\Session::setFlash()时, 会自动覆盖相同名的已存在的任何数据， 为将数据追加到已存在的相同名flash中，可改为调用yii\web\Session::addFlash()。 例如:

$session = Yii::$app->session;

// 请求 #1
// 在名称为"alerts"的flash信息增加数据
$session->addFlash('alerts', 'You have successfully deleted your post.');
$session->addFlash('alerts', 'You have successfully added a new friend.');
$session->addFlash('alerts', 'You are promoted.');

// 请求 #2
// $alerts 为名为'alerts'的flash信息，为数组格式
$alerts = $session->getFlash('alerts');
注意: 不要在相同名称的flash数据中使用yii\web\Session::setFlash() 的同时也使用yii\web\Session::addFlash()， 因为后一个防范会自动将flash信息转换为数组以使新的flash数据可追加进来，因此， 当你调用yii\web\Session::getFlash()时，会发现有时获取到一个数组，有时获取到一个字符串， 取决于你调用这两个方法的顺序。

Cookies

Yii使用 yii\web\Cookie对象来代表每个cookie，yii\web\Request 和 yii\web\Response 通过名为'cookies'的属性维护一个cookie集合，前者的cookie 集合代表请求提交的cookies， 后者的cookie集合表示发送给用户的cookies。

读取 Cookies

当前请求的cookie信息可通过如下代码获取：

// 从 "request"组件中获取cookie集合(yii\web\CookieCollection)
$cookies = Yii::$app->request->cookies;

// 获取名为 "language" cookie 的值，如果不存在，返回默认值"en"
$language = $cookies->getValue('language', 'en');

// 另一种方式获取名为 "language" cookie 的值
if (($cookie = $cookies->get('language')) !== null) {
    $language = $cookie->value;
}

// 可将 $cookies当作数组使用
if (isset($cookies['language'])) {
    $language = $cookies['language']->value;
}

// 判断是否存在名为"language" 的 cookie
if ($cookies->has('language')) ...
if (isset($cookies['language'])) ...
发送 Cookies

You can send cookies to end users using the following code: 可使用如下代码发送cookie到终端用户：

// 从"response"组件中获取cookie 集合(yii\web\CookieCollection)
$cookies = Yii::$app->response->cookies;

// 在要发送的响应中添加一个新的cookie
$cookies->add(new \yii\web\Cookie([
    'name' => 'language',
    'value' => 'zh-CN',
]));

// 删除一个cookie
$cookies->remove('language');
// 等同于以下删除代码
unset($cookies['language']);
除了上述例子定义的 yii\web\Cookie::name 和 yii\web\Cookie::value 属性 yii\web\Cookie 类也定义了其他属性来实现cookie的各种信息，如 yii\web\Cookie::domain, yii\web\Cookie::expire 可配置这些属性到cookie中并添加到响应的cookie集合中。

注意: 为安全起见yii\web\Cookie::httpOnly 被设置为true，这可减少客户端脚本访问受保护cookie（如果浏览器支持）的风险， 更多详情可阅读 httpOnly wiki article for more details.
Cookie验证

                                                                                                               在上两节中，当通过request 和 response 组件读取和发送cookie时，你会喜欢扩展的cookie验证的保障安全功能，它能 使cookie不被客户端修改。该功能通过给每个cookie签发一个哈希字符串来告知服务端cookie是否在客户端被修改， 如果被修改，通过request组件的yii\web\Request::cookiescookie集合访问不到该cookie。

注意: Cookie验证只保护cookie值被修改，如果一个cookie验证失败，仍然可以通过$_COOKIE来访问该cookie， 因为这是第三方库对未通过cookie验证自定义的操作方式。
Cookie验证默认启用，可以设置yii\web\Request::enableCookieValidation属性为false来禁用它，尽管如此，我们强烈建议启用它。

注意: 直接通过$_COOKIE 和 setcookie() 读取和发送的Cookie不会被验证。
当使用cookie验证，必须指定yii\web\Request::cookieValidationKey，它是用来生成s上述的哈希值， 可通过在应用配置中配置request 组件。

return [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'fill in a secret key here',
        ],
    ],
];
补充: yii\web\Request::cookieValidationKey 对你的应用安全很重要， 应只被你信任的人知晓，请不要将它放入版本控制中。
?>

