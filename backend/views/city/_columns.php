<?php
use yii\helpers\{Url, Html, ArrayHelper};
use common\models\{City, Region};
use kartik\grid\GridView;

$regions = ArrayHelper::map(Region::getAllRegions(), 'id', 'nameru');

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

   /* [
        'attribute' => 'idcountry',
        'value' => function($model) {
            return ArrayHelper::getValue(City::$countries, $model->idcountry);
        }
    ],*/
    [
        'attribute' => 'idregion',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Region::getAllRegions(), 'id', 'nameru'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
        'value' => function($model) use($regions) {
            $region = ArrayHelper::getValue($regions, $model->idregion);
            return $region;
        }
    ],
    [
        'attribute' => 'nameru',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(City::getAllCities(), 'nameru', 'nameru'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотреть','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Редактировать', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Вы уверены?',
            'data-confirm-message'=>'Вы уверены, что хотите удалить запись'],
    ],

];   