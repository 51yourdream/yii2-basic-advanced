<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2016/1/5
 * Time: 11:36
 */

预定16种抽象类型
    const TYPE_PK = 'pk';
    const TYPE_BIGPK = 'bigpk';
    const TYPE_STRING = 'string';
    const TYPE_TEXT = 'text';
    const TYPE_SMALLINT = 'smallint';
    const TYPE_INTEGER = 'integer';
    const TYPE_BIGINT = 'bigint';
    const TYPE_FLOAT = 'float';
    const TYPE_DOUBLE = 'double';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATETIME = 'datetime';
    const TYPE_TIMESTAMP = 'timestamp';
    const TYPE_TIME = 'time';
    const TYPE_DATE = 'date';
    const TYPE_BINARY = 'binary';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_MONEY = 'money';
?>
如下是所有这些数据库访问方法的列表：

yii\db\Migration::execute(): 执行一条 SQL 语句
yii\db\Migration::insert(): 插入单行数据
yii\db\Migration::batchInsert(): 插入多行数据
yii\db\Migration::update(): 更新数据
yii\db\Migration::delete(): 删除数据
yii\db\Migration::createTable(): 创建表
yii\db\Migration::renameTable(): 重命名表名
yii\db\Migration::dropTable(): 删除一张表
yii\db\Migration::truncateTable(): 清空表中的所有数据
yii\db\Migration::addColumn(): 加一个字段
yii\db\Migration::renameColumn(): 重命名字段名称
yii\db\Migration::dropColumn(): 删除一个字段
yii\db\Migration::alterColumn(): 修改字段
yii\db\Migration::addPrimaryKey(): 添加一个主键
yii\db\Migration::dropPrimaryKey(): 删除一个主键
yii\db\Migration::addForeignKey(): 添加一个外键
yii\db\Migration::dropForeignKey(): 删除一个外键
yii\db\Migration::createIndex(): 创建一个索引
yii\db\Migration::dropIndex(): 删除一个索引
<?php
public function up()
{
    $this->createTable('kxw_news1', [
        'id' => Schema::TYPE_PK,
        'title' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "QQ" COMMENT "标题"',
        'content' => Schema::TYPE_TEXT,
    ]);
//    做插入数据修改数据啊等操作
}

    public function down()
{
    $this->dropTable('kxw_news1');

    return false;
}

======================================================
        事务处理
public function safeUp()
{
    $this->createTable('kxw_news1', [
        'id' => Schema::TYPE_PK,
        'title' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "QQ" COMMENT "标题"',
        'content' => Schema::TYPE_TEXT,
    ]);
//    做插入数据修改数据啊等操作
}

    public function safeDown()
{
    $this->dropTable('kxw_news1');

    return false;
}
?>
提交数据库的迁移
 yii migrate

指定提交条数
yii migrate 3  //尝试提交前3个可用的迁移

指定提交特定迁移

yii migrate/to 150101_185401                      # using timestamp to specify the migration 使用时间戳来指定迁移
yii migrate/to "2015-01-01 18:54:01"              # using a string that can be parsed by strtotime() 使用一个可以被 strtotime() 解析的字符串
yii migrate/to m150101_185401_create_news_table   # using full name 使用全名
yii migrate/to 1392853618

还原迁移
yii migrate/down     # revert the most recently applied migration 还原最近一次提交的迁移
yii migrate/down 3   # revert the most 3 recently applied migrations 还原最近三次提交的迁移

重做迁移
重做迁移的意思是先还原指定的迁移，然后再次提交。如下所示：
yii migrate/redo        # redo the last applied migration 重做最近一次提交的迁移
yii migrate/redo 3      # redo the last 3 applied migrations 重做最近三次提交的迁移

列出迁移
你可以使用如下命令列出那些提交了的或者是还未提交的迁移：

yii migrate/history     # 显示最近10次提交的迁移
yii migrate/history 5   # 显示最近5次提交的迁移
yii migrate/history all # 显示所有已经提交过的迁移

yii migrate/new         # 显示前10个还未提交的迁移
yii migrate/new 5       # 显示前5个还未提交的迁移
yii migrate/new all     # 显示所有还未提交的迁移

修改迁移历史

有时候你也许需要简单的标记一下你的数据库已经升级到一个特定的迁移，而不是实际提交或者是还原迁移。这个经常会发生在你手动的改变数据库的一个特定状态，而又不想相应的迁移被重复提交。那么你可以使用如下命令来达到目的：

yii migrate/mark 150101_185401                      # 使用时间戳来指定迁移
yii migrate/mark "2015-01-01 18:54:01"              # 使用一个可以被 strtotime() 解析的字符串
yii migrate/mark m150101_185401_create_news_table   # 使用全名
yii migrate/mark 1392853618

==========================================================================
需要创建新的 migrate文件的话执行以下命令:
yii migrate/create

运行最近一次创建的 migrate文件 可以执行下面的命令
yii migrate/up
yii migrate/down

执行migrate文件 使用下面的命令
yii migrate console/migrations/m160107_022238_newuser.php 文件

用以下命令可以查看 migrate历史版本
yii migrate/history 默认系显示最近10次的迁移记录
yii migrate/history 5 显示最近五次的迁移
yii migrate/history all 显示所有已经提交过的迁移

可以用 一下命令查看未提交的迁移
yii migrate/new 默认显示前10个未提交的迁移
yii migrate/new 显示前5个还未提交的迁移
yii migrate/new all 显示所有还未提交的迁移

修改迁移历史版本
有时候你需要标记一下你的数据库已经升级到一个特定的迁移
而不是实际提交或者还原迁移。
这个经常回发生在你手动的改变数据库的一个特定状态，
而又不想响应的迁移被重复提交。
那么你可以使用如下的命令来达到目的
yii migrate/mark 150101_185401 //指定时间戳
yii migrate/mark  "2015-01-01 18:54:01" //使用一个可以被 strtotime() 解析的字符串
yii migrate/mark m150101_185401_create_news_table   # 使用全名
yii migrate/mark 1392853618                         # 使用 UNIX 时间戳

如果有多个 migrate文件 可以用一下命令迁移到指定版本
yii migrate/to 文件名称/时间戳/日期2016-01-12/
yii migrate/to 150101_185401          //时间戳
yii migrate/to "2015-01-01 18:54:01"  //日期
yii migrate/to m150101_185401_create_news_table //migrate 文件全称
yii migrate/to 1392853618         //unix时间戳


还原迁移
自定义还原几个迁移
yii migrate/down 默认一个
yii migrate/down 3 还原三个

重做迁移（先还原到指定的迁移，在次提交迁移）
yii migrate/redo 默认重做一次
yii migrate/redo 3 自定义重做三次

不常用操作
如果我们需要迁移一个 forum 模块，而该迁移文件放在该模块下的 migrations 目录当中，那么我们可以使用如下命令：

# 在 forum 模块中以非交互模式进行迁移
yii migrate --migrationPath=@app/modules/forum/migrations --interactive=0  // interactive=0 在后台运行不提示用户 interactive=1 提示用户

===========================================
全局配置命令
在运行迁移命令的时候每次都要重复的输入一些同样的参数会很烦人，这时候，你可以选择在应用程序配置当中进行全局配置，一劳永逸
<?php
    return [
        'controllerMap' => [
            'migrate' => [
                'class' => 'yii\console\controllers\MigrateController',
                'migrationTable' => 'backend_migration',
            ],
        ],
    ];
?>
如上所示配置，在每次运行迁移命令的时候，backend_migration 表将会被用来记录迁移历史。
你再也不需要通过 migrationTable 命令行参数来指定这张历史纪录表了。

迁移多个数据库
默认情况下，迁移将会提交到由 db application component
所定义的同一个数据库当中。如果你需要提交到不同的数据库，
你可以像下面那样指定 db 命令行选项

yii migrate --db=db2

上面的命令将会把迁移提交到 db2 数据库当中。

偶尔有限时候你需要提交 一些 迁移到一个数据库，而另外一些则提交到另一个数据库。为了达到这个目的，
你应该在实现一个迁移类的时候指定需要用到的数据库组件的 ID ， 如下所示：
<?php
    use yii\db\Schema;
    use yii\db\Migration;

    class m150101_185401_create_news_table extends Migration
    {
        public function init()
        {
            $this->db = 'db2';
            parent::init();
        }
    }
?>
即使你使用 db 命令行选项指定了另外一个不同的数据库，上面的迁移还是会被提交到 db2 当中。
需要注意的是这个时候迁移的历史信息依然会被记录到 db 命令行选项所指定的数据库当中。

如果有多个迁移都使用到了同一个数据库，那么建议你创建一个迁移的基类，里面包含上述的 init() 代码。
然后每个迁移类都继承这个基类就可以了。

提示：除了在 yii\db\Migration::db 参数当中进行设置以外，你还可以通过在迁移类中创建新的数据库连接来操作不同的数据库。
然后通过这些连接再使用 DAO 方法 来操作不同的数据库。

另外一个可以让你迁移多个数据库的策略是把迁移存放到不同的目录下，
然后你可以通过如下命令分别对不同的数据库进行迁移：

yii migrate --migrationPath=@app/migrations/db1 --db=db1
yii migrate --migrationPath=@app/migrations/db2 --db=db2
...
第一条命令将会把 @app/migrations/db1 目录下的迁移提交到 db1 数据库当中，

第二条命令则会把 @app/migrations/db2 下的迁移提交到 db2 数据库当中，以此类推。

