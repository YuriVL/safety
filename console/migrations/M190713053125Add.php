<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M190713053125Add
 */
class M190713053125Add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'documents_to', $this->integer(11) . ' COMMENT "Срок действия документов" AFTER `email`');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%user}}', 'documents_to', $this->integer() . ' COMMENT "Срок действия документов" AFTER `email`');
    }

}
