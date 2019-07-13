<?php
use yii\helpers\{Url, Html, ArrayHelper};
use common\models\Organization;
use backend\models\helpers\EnumColumn;
use kartik\grid\GridView;

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
        'attribute' => 'name',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Organization::getAllOrganizations(), 'name', 'name'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Все'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'hash',
        'value' => function($model){
            return Html::a($model->hash, ['/file-manager', 'hash'=>$model->hash], ['title'=>'Перейти в файловый менеджер', 'target' => '_blank']);
        },

        'format' => 'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class' => EnumColumn::class,
        'attribute' => 'status',
        'enum' => Organization::statuses(),
        'filter' => Organization::statuses()
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