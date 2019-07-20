<?php
use yii\helpers\Url;

$this->title = 'Уведомления | Задать вопрос';

/** @var \ricco\ticket\models\TicketHead $ticketHead */
/** @var \ricco\ticket\models\TicketBody $ticketBody */
?>
<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs' => [['label'=>'Тикеты', 'url'=>'/ticket'], $this->title]]); ?>
    <div class="row">
        <div class="col-sx-12">
            <?php $form = \yii\widgets\ActiveForm::begin([]) ?>
            <div class="col-xs-12">
                <?= $form->field($ticketBody, 'name_user')->textInput([
                    'readonly' => '',
                    'value' => Yii::$app->user->identity['username'],
                ])->label('Имя пользователя') ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($ticketHead, 'topic')->textInput()->label('Сообщение')->error() ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($ticketHead, 'department')->dropDownList($qq)->label('Тема') ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($ticketBody, 'text')->textarea([
                    'style' => 'height: 150px; resize: none;',
                ])->label('Описание') ?>
            </div>
            <div class="col-xs-12">
                <?= $form->field($fileTicket, 'fileName[]')->fileInput([
                    'multiple' => true,
                    'accept' => 'image/*',
                ])->label(false); ?>
            </div>
            <div class="text-center">
                <button class='btn btn-primary'>Отправить</button>
            </div>
            <?php $form->end() ?>
        </div>

    </div>
</div>
