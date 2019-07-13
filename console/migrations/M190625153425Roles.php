<?php

namespace console\migrations;

use Yii;
use yii\db\Migration;
use common\models\User;

/**
 * Class M190625153425Roles
 */
class M190625153425Roles extends Migration
{
    public function up() {
        $auth = Yii::$app->authManager;

        $content = $auth->createRole(User::ROLE_CONTENT);
        $auth->add($content);

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $auth->add($manager);

        $admin = $auth->createRole(User::ROLE_ADMINISTRATOR);
        $auth->add($admin);

        $auth->addChild($manager, $content);
        $auth->addChild($admin, $manager);

        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getRole(User::ROLE_ADMINISTRATOR));
        $auth->remove($auth->getRole(User::ROLE_MANAGER));
        $auth->remove($auth->getRole(User::ROLE_CONTENT));
    }
}
