<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
?>

<main class="login-form-wrapper site-request-password-reset">
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="login-form">
                        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                        <h2 class="h2">
                            <?= Html::encode($this->title) ?>
                        </h2>

                        <h4>
                            Пожалуйста укажите свой новый пароль:
                        </h4>

                        <?= $form->field($model, 'password', ['template' => '{input}{label}{error}'])->passwordInput(['autofocus' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn orange']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>