<?php
use yii\helpers\Url;
use backend\models\helpers\EnumColumn;
use common\models\{User, Organization};
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'attribute' => 'organization_id',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Organization::getAllOrganizations(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
        'value' => function($model){
            return $model->organization->name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name_full',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
       'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class' => EnumColumn::class,
        'attribute' => 'status',
        'enum' => User::statuses(),
        'filter' => User::statuses()
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