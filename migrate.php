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
