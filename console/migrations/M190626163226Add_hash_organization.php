<?php

namespace console\migrations;

use yii\db\Migration;
use common\models\Organization;
/**
 * Class M190626163226Add_hash_organization
 */
class M190626163226Add_hash_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%organization}}', 'hash', $this->string(255) . ' COMMENT "Хэш" AFTER `parent_id`');
        $models = Organization::find()->all();
        foreach ($models as $model){
            $model->hash = hash('md5', $model->name .$model->city_id);
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%organization}}', 'hash');
    }

}
