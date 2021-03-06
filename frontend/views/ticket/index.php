<?php

use yii\helpers\Url;
use ricco\ticket\models\TicketHead;

/** @var TicketHead $dataProvider */

$this->title = 'Уведомления';

$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
           location.href = '" . Url::toRoute(['ticket/view', 'id' => '']) . "' + id ;
    });

");
?>
<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs' => [$this->title]]); ?>
    <div class="row">
        <div class="col-lg-12">
            <a type="button" href="<?= Url::to(['ticket/open']) ?>" class="btn btn-primary pull-right"
               style="margin-right: 10px">Открыть</a>
            <div class="clearfix" style="margin-bottom: 10px"></div>
            <div>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'rowOptions' => function ($model) {
                        return ['data-id' => $model->id, 'class' => 'ticket'];
                    },
                    'columns' => [
                        'department',
                        'topic',
                        [
                            'contentOptions' => [
                                'style' => 'text-align:center;',
                            ],
                            'attribute' => 'status',
                            'value' => function ($model) {
                                switch ($model['status']) {
                                    case TicketHead::OPEN :
                                        return '<div class="label label-default">Открыт</div>';
                                    case TicketHead::WAIT :
                                        return '<div class="label label-warning">Ожидание</div>';
                                    case TicketHead::ANSWER :
                                        return '<div class="label label-success">Отвечен</div>';
                                    case TicketHead::CLOSED :
                                        return '<div class="label label-info">Закрыт</div>';
                                    case TicketHead::VIEWED :
                                        return '<div class="label label-info">Просмотрен</div>';
                                }
                            },
                            'format' => 'html',
                            'label'=>'Статус'
                        ],
                        [
                            'contentOptions' => [
                                'style' => 'text-align:right; font-size:13px',
                            ],
                            'attribute' => 'date_update',
                            'value' => "date_update",
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

