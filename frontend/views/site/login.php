<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход в личный кабинет';
?>
<main class="login-form-wrapper">
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="login-form">
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-vertical']); ?>
                        <h2 class="h2">
                            <?= Html::encode($this->title) ?>
                        </h2>

                        <div class="row">
                            <?php echo $form->field($model, 'email', ['template' => '{input}{label}{error}'])->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="row">
                            <?php echo $form->field($model, 'password', ['template' => '{input}{label}{error}'])->passwordInput()->label('Пароль') ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <input type="checkbox" id="agree" name="agree">
                                <label for="agree"><span></span>
                                    <div class="checkbox-text">Запомнить меня</div>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <?= $form->field($model, 'rememberMe')->checkbox()->label(false) ?>
                        </div>
                        <div class="row">
                            <?= Html::submitButton('Вход', ['class' => 'btn orange']) ?>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="restore">
                                    <?= Html::a('Восстановить пароль', ['request-password-reset']) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <button type="button" class="btn transparent" onclick="">
                                <?= Html::a('Регистрация', ['signup']) ?>
                            </button>

                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>