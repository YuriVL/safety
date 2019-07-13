<?php

use yii\helpers\Url;

use common\models\{
    News, User, Organization
};
use backend\models\helpers\EnumColumn;
use kartik\daterange\DateRangePicker;

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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'title',
    ],
    [
        'class' => EnumColumn::class,
        'attribute' => 'status',
        'enum' => News::statuses(),
        'filter' => News::statuses()
    ],
    [
        'attribute' => 'created_at',
        'format' => 'datetime',
        'filter' => DateRangePicker::widget(
            [
                'name' => 'created_at',
                'convertFormat' => true,
                'presetDropdown' => true,
                'options' => [
                    'class' => 'form-control',
                ],
                'pluginOptions' => [
                    'format' => 'd-m-Y H:i:s',
                    'dateLimit' => ['months' => 6],
                    'opens' => 'left'
                ],
            ]
        )
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => function ($model) {
            $user = User::findOne($model->user_id);
            return $user->username;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'organizations',
        'value' => function ($model) {
            $organizations = json_decode($model->organizations);
            if(!empty($organizations)){
                $organizations = Organization::getOrganizations(['in', 'id', $organizations]);
                $organizations = \yii\helpers\ArrayHelper::map($organizations, 'id', 'name');
                $organizations = implode(', ', $organizations);
            }
            return $organizations;
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'Просмотреть', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Редактировать', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Удалить',
            'data-confirm' => false, 'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Вы уверены?',
            'data-confirm-message' => 'Вы уверены, что хотите удалить запись'],
    ],

];   