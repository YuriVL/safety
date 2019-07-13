<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'app/bower_components/slick-carousel/slick/slick-theme.css',
        'app/bower_components/slick-carousel/slick/slick.css',
        'app/css/main.css',
    ];
    public $js = [
        'app/bower_components/slick-carousel/slick/slick.js',
        'app/bower_components/jquery-mask-plugin/src/jquery.mask.js',
        'app/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
