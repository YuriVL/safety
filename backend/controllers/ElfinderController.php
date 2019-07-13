<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26.06.2019
 * Time: 22:43
 */

namespace backend\controllers;

use mihaildev\elfinder\Controller;

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
}