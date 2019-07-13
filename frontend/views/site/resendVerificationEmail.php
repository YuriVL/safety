<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отправка письма с подтверждением';
?>
<main class="login-form-wrapper site-resend-verification-email">
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="login-form">
                        <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form', 'class' => 'form-vertical']); ?>
                        <h2 class="h2">
                            <?= Html::encode($this->title) ?>
                        </h2>

                        <h4>
                            Укажите Ваш email. На него будет отправлено письмо с подтверждением.
                        </h4>

                        <div class="row">
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                        </div>

                        <div class="row">
                            <?= Html::submitButton('Отправить', ['class' => 'btn orange']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>