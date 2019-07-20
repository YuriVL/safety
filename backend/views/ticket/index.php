<?php
/** @var \ricco\ticket\models\TicketHead $dataProvider */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

$this->title = 'Уведомления от пользователей';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<div class="ticket-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
                        'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['admin/open'],
                    ['role'=>'modal-remote','title'=> 'Добавить тикет','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновить список']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Список тикетов',
            ],

            'rowOptions' => function ($model) {
                $background = '';
                if ($model->status == 0 || $model->status == 1) {
                    $background = 'background:#E6E6FA';
                }
                return [
                    'style' => "cursor:pointer;" . $background,
                ];
            },
        ]) ?>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>