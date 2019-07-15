<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26.06.2019
 * Time: 22:43
 */

namespace backend\controllers;

use mihaildev\elfinder\Controller;
use Yii;

/**
 * Class ElfinderController
 * Ovveride Elfinder controller method actionManager
 * @package backend\controllers
 */
class ElfinderController extends Controller
{
    public function actionManager(){
        return $this->renderFile("@backend/views/file-manager/manager.php", [
            'options'=>$this->getManagerOptions(),
            'startPathHash'=> \Yii::$app->request->getQueryParam('target', false)
        ]);
    }

    public function beforeAction($action)
    {
        $user=Yii::$app->user->identity;

        if($user !== null){
            $auth = Yii::$app->authManager;

            $roles = $auth->getRolesByUser($user->getId());

            foreach ($roles as $roleId=>$role){
                if($roleId !== \common\models\User::ROLE_ADMINISTRATOR) {
                    Yii::$app->user->logout();
                    return $this->redirect(\Yii::getAlias('@frontendUrl'));
                }
            }

        }

        return parent::beforeAction($action);
    }
}