<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190625135505Add_user_fields
 */
class M190625135505Add_user_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'name_full', $this->string(255) . ' COMMENT "Полное имя" AFTER `username`');
        $this->addColumn('{{%user}}', 'name_short', $this->string(255) . ' COMMENT "Короткое имя" AFTER `name_full`');
        $this->addColumn('{{%user}}', 'position', $this->string(255) . ' COMMENT "Должность" AFTER `name_short`');
        $this->addColumn('{{%user}}', 'phone', $this->string(100) . ' COMMENT "Телефон" AFTER `position`');
        $this->addColumn('{{%user}}', 'organization_id', $this->integer() . ' COMMENT "id организации" AFTER `phone`');
        $this->addForeignKey(
            'fk_user_organization',
            '{{%user}}',
            'organization_id',
            '{{%organization}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `news_category`
        $this->dropForeignKey(
            'fk_user_organization',
            '{{%user}}'
        );

        $this->dropColumn('{{%user}}', 'name_full');
        $this->dropColumn('{{%user}}', 'name_short');
        $this->dropColumn('{{%user}}', 'position');
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'organization_id');
    }
}
