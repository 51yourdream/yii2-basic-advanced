<?php

use yii\db\Schema;
use yii\db\Migration;

class m160105_022658_create_news_table extends Migration
{
    public function up()
    {
        $this->createTable('kxw_news', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "QQ"',
            'content' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable('kxw_news');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
