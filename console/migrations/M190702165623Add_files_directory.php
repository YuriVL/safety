<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190702165623Add_files_directory
 */
class M190702165623Add_files_directory extends Migration
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

        $this->createTable('{{%files_directory}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'comment' => $this->text(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files_directory}}');
    }
}
