<?php

use yii\db\Migration;
use yii\db\Schema;

class m161228_073202_create_table_session extends Migration
{
    const TABLE_SESSION = '{{%session}}';

    public function up()
    {
        $options = null;
        if($this->db->driverName == 'mysql') {
            $options = 'Engine = InnoDB DEFAULT CHARSET utf8 COLLATE utf8_unicode_ci';
        }

        $this->createTable(self::TABLE_SESSION, [
            'id' => Schema::TYPE_CHAR . '(64) NOT NULL PRIMARY KEY',
            'expire' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "有效期"',
            'data' => 'longblob COMMENT "数据"',
        ], $options);

        $this->addCommentOnTable(self::TABLE_SESSION, 'SESSION会话表');

    }

    public function down()
    {
        $this->dropTable(self::TABLE_SESSION);
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
