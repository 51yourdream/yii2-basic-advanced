<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_022238_newuser extends Migration
{
    const TBL_NAME = '{{%newuser}}';

    // Use safeUp/safeDown to run migration code within a transaction

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TBL_NAME, [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL COMMENT "用户名"',
            'password' => Schema::TYPE_STRING . '(32) NOT NULL COMMENT "密码"',
            'email' => Schema::TYPE_STRING . ' NOT NULL COMMENT "邮箱"',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10 COMMENT "角色"',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10 COMMENT "状态"',
            'create_time' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "注册时间"',
            'updated_time' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "修改时间"',
        ], $tableOptions);

        $this->createIndex('username', self::TBL_NAME, ['username'],true);
        $this->createIndex('email', self::TBL_NAME, ['email'],true);

        //插入数据

        $this->insert(self::TBL_NAME,[
                'username'=>'lipeng',
                'password'=>md5('123456'),
                'email'=>'lpjustdoit@163.com',
                'create_time'=>time(),
            ]);

    }
    public function safeDown()
    {
        $this->dropTable(self::TBL_NAME);

    }

}
