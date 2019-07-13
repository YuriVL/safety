<?php

namespace console\migrations;

use Yii;
use yii\db\Migration;
use common\models\User;

/**
 * Class M190625153644Init_permissions
 */
class M190625153644Init_permissions extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $managerRole = $auth->getRole(User::ROLE_MANAGER);

        $loginToBackend = $auth->createPermission('loginWithAdmin');
        $auth->add($loginToBackend);
        $auth->addChild($managerRole, $loginToBackend);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('loginWithAdmin'));
    }
}
