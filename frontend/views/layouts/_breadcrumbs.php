<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $breadcrumbs array */

echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => $breadcrumbs,
    'encodeLabels' => false,
    'homeLink' => [
        'label' => 'Главная',
        'url' => '/dashboard',
        ]
]);