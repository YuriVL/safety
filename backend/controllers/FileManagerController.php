<?php

namespace backend\controllers;

class FileManagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $hash = \Yii::$app->request->getQueryParam('hash', null);
        return $this->render('index', ['hash'=>$hash]);
    }
}