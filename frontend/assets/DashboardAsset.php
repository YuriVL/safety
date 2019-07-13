<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 02.07.2019
 * Time: 18:33
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'app/css/fonts.css',
        'app/css/lk.css',
        'app/css/jquery.resizableColumns.min.css',
        'app/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css',
    ];
    public $js = [
        'app/js/dashboard.js',
        'app/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}