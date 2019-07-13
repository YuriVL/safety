<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%news}}`.
 */
class M190704062849Create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'annonce' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'user_id' => Schema::TYPE_INTEGER,
            'organizations' => Schema::TYPE_TEXT,
        ], $tableOptions);

        // Indexes
        $this->createIndex('status', '{{%news}}', 'status');
        $this->createIndex('created_at', '{{%news}}', 'created_at');
        $this->createIndex('updated_at', '{{%news}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
