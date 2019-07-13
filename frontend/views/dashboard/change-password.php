<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\ChangePassword;

/* @var $this yii\web\View */

/* @var $user \common\models\User */
/* @var $model ChangePassword */

$this->title = 'Смена пароля';

$organization = $user->organization;

?>

<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs' => [['label'=>'Профиль', 'url'=>'/profile'], $this->title]]); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Сменить пароль</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'change-password']); ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Старый пароль') ?>
                    <?= $form->field($model, 'newPassword')->passwordInput()->label('Новый пароль') ?>
                    <?= $form->field($model, 'credentialPassword')->passwordInput()->label('Пароль еще раз') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>