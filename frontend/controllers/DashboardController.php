<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.07.2019
 * Time: 18:26
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\ChangePassword;
use backend\models\UserForm;

class DashboardController extends Controller
{

    public function beforeAction($action)
    {
        $this->layout = "@frontend/views/layouts/dashboard.php";
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', ['user'=>\Yii::$app->user->getIdentity()]);
    }

    public function actionNews()
    {
        return $this->render('news', ['user'=>\Yii::$app->user->getIdentity()]);
    }

    public function actionDocs()
    {
        return $this->render('docs', ['user'=>\Yii::$app->user->getIdentity()]);
    }

    public function actionProfile()
    {
        return $this->render('profile', ['user'=>\Yii::$app->user->getIdentity()]);
    }

    public function actionProfileEdit()
    {
        $request = Yii::$app->request;
        $user = \Yii::$app->user->getIdentity();
        $model = new UserForm();
        $model->setModel($user);

        if ($model->load($request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно изменены');
            } else {
                Yii::$app->session->setFlash('error', 'Извините, нам удалось изменить данные.');
            }
        } /*else {
var_dump($model->getErrors());
        }*/

        return $this->render('profile-edit', ['user'=>$user, 'model'=>$model]);
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->changeUserPassword()) {
                Yii::$app->session->setFlash('success', 'Пароль был успешно изменен');
            } else {
                Yii::$app->session->setFlash('error', 'Извините, мы не смогли сменить пароль.');
            }
        }


        return $this->render('change-password', [
            'user'=>\Yii::$app->user->getIdentity(),
            'model'=>$model
        ]);
    }

    /**
     * Getting filse tree
     */
    public function actionGetTree($directory)
    {
        /** @var  \common\models\Organization $organization */
        $organization = \Yii::$app->user->getIdentity()->organization ?? false;

        $request = Yii::$app->request;
        if ($request->isAjax && $organization && $organization->hash == $directory) {
            Yii::$app->response->content = json_encode($organization->getFilesTree());
        }
        Yii::$app->response->statusCode = 200;
        Yii::$app->response->send();
        Yii::$app->end();
    }
}