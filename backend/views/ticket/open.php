<?php
/** @var \ricco\ticket\models\TicketHead $ticketHead */
use yii\helpers\{ArrayHelper};
use kartik\select2\Select2;
use common\models\User;

/** @var \ricco\ticket\models\TicketBody $ticketBody */
?>
<div class="ticket-create">
            <div class="ticket-form">
                <?php $form = \yii\widgets\ActiveForm::begin([]) ?>


                <?= $form->field($ticketHead, 'user_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(User::getActiveClients(), 'id', 'username'),
                    'options' => ['placeholder' => 'Выберите пользователя'],
                    'initValueText' => true
                ])->label('Имя пользователя')?>

                <?= $form->field($ticketHead, 'department')
                    ->dropDownList($qq)
                    ->label('Сообщение')->error() ?>
                <?= $form->field($ticketHead, 'topic')
                    ->textInput() ?>
                <?= $form->field($ticketBody, 'text')
                    ->textarea([
                        'style' => 'height: 150px; resize: none;',
                    ])->label('Сообщение'); ?>
                <?= $form->errorSummary($ticketBody) ?>
                <?php $form->end() ?>
            </div>
        </div>

    </div>
</div>
