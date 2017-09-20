<?php

use yii\db\Migration;
use yii\db\Schema;

class m161227_022529_create_table_news extends Migration
{
    const TABLE_NEWS = '{{%news}}';

    public function up()
    {
        $options = null;
        if($this->db->driverName == 'mysql') {
            $options = 'Engine = InnoDB DEFAULT CHARSET utf8 COLLATE utf8_unicode_ci';
        }

        $this->dropTable(self::TABLE_NEWS);

        $this->createTable(self::TABLE_NEWS, [
            'id' => Schema::TYPE_PK,
            'author' => Schema::TYPE_STRING,
            'title' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT,
            'is_original' => Schema::TYPE_SMALLINT,
            'original_title' => Schema::TYPE_STRING,
            'original_url' => Schema::TYPE_STRING,
            'create_time' => Schema::TYPE_INTEGER,
            'update_time' => Schema::TYPE_INTEGER,
        ], $options);

        $this->addCommentOnColumn(self::TABLE_NEWS, 'id', '主键');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'author', '作者');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'title', '标题');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'content', '内容');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'is_original', '是否原创(0否1是)');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'original_title', '原文标题');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'original_url', '原文链接');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'create_time', '添加时间');
        $this->addCommentOnColumn(self::TABLE_NEWS, 'update_time', '更新时间');

        $this->addCommentOnTable(self::TABLE_NEWS, '新闻表');
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NEWS);
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
