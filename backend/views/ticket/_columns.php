<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14.07.2019
 * Time: 15:22
 */

use yii\helpers\{
    Html, Url
};
use ricco\ticket\models\TicketHead;

$statuses = [
    TicketHead::OPEN => 'Открыт',
    TicketHead::WAIT => 'Ожидает',
    TicketHead::ANSWER => 'Отвечен',
    TicketHead::CLOSED => 'Закрыт',
    TicketHead::VIEWED => 'Просмотрен',
];

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
        'attribute' => 'userName',
        'value' => 'userName.username',
        'label' => 'Пользователь'
    ],
    [
        'attribute' => 'department',
        'value' => 'department',
        'label' => 'Тема сообщения'
    ],
    [
        'attribute' => 'topic',
        'value' => 'topic',
        'label' => 'Заголовок'
    ],
    [
        'attribute' => 'status',
        'label' => 'Статус',
        'value' => function ($model) use($statuses) {
            switch ($model->body['client']) {
                case 0 :
                    return '<div class="label label-success">Клиент</div>&nbsp;<div class="label label-default">'.$statuses[$model->status].'</div>';
                case 1 :
                    return '<div class="label label-primary">Администратор</div>&nbsp;<div class="label label-default">'.$statuses[$model->status].'</div>';
            }
        },
        'format' => 'html',
    ],
    [
        'attribute' => 'date_update',
        'value' => 'date_update',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'template' => '{update}&nbsp;{delete}&nbsp;{closed}',
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'update' => function ($url, $model) {
                return
                    Html::a('Ответить', ['admin/answer', 'id' => $model['id']],
                        ['role' => 'modal-remote', 'title' => 'Ответ на тикет', 'class' => 'btn-xs btn-info']);
            },
            'delete' => function ($url, $model) {
                return Html::a('Удалить',
                    Url::to(['admin/delete', 'id' => $model['id']]),
                    [
                        'class' => 'btn-xs btn-danger',
                        'onclick' => 'return confirm("Вы действительно хотите удалить?")',
                    ]
                );
            },
            'closed' => function ($url, $model) {
                return Html::a('Закрыть',
                    Url::to(['admin/closed', 'id' => $model['id']]),
                    [
                        'class' => 'btn-xs btn-primary',
                        'onclick' => 'return confirm("Вы действительно хотите закрыть тикет?")',
                    ]
                );
            },
        ],
    ],
];