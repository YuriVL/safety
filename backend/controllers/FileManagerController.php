<?php

namespace backend\controllers;

class FileManagerController extends BackendController
{
    public function actionIndex()
    {
        $hash = \Yii::$app->request->getQueryParam('hash', null);
        return $this->render('index', ['hash'=>$hash]);
    }
}