<?php
use yii\helpers\{Url, Html, ArrayHelper};
use common\models\FilesDirectory;
use backend\models\helpers\EnumColumn;
use kartik\grid\GridView;

$parents = ArrayHelper::map(FilesDirectory::getAllDirectories(),'id', 'title');

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slug',
    ],
    [
        'attribute' => 'title',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(FilesDirectory::getAllDirectories(), 'title', 'title'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'comment',
    ],
    [
        'attribute' => 'parent_id',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(FilesDirectory::getAllDirectories(), 'id', 'title'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
        'value' => function($model) use($parents){
            return $parents[$model->parent_id];
        }
    ],
    [
        'class' => EnumColumn::class,
        'attribute' => 'status',
        'enum' => FilesDirectory::statuses(),
        'filter' => FilesDirectory::statuses()
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