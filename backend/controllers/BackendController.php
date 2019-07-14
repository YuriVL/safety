<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14.07.2019
 * Time: 23:39
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;

class BackendController extends Controller
{

    public function beforeAction($action)
    {
        $user=Yii::$app->user->identity;

        if($user !== null){
            $auth = Yii::$app->authManager;

            $roles = $auth->getRolesByUser($user->getId());

            foreach ($roles as $roleId=>$role){

                if($roleId !== User::ROLE_ADMINISTRATOR) {
                    Yii::$app->user->logout();
                    return $this->redirect(\Yii::getAlias('@frontendUrl'));
                }
            }
        }

        return parent::beforeAction($action);
    }
}