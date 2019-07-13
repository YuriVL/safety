<?php

use yii\helpers\{Html, ArrayHelper};
use yii\bootstrap\ActiveForm;
use backend\models\UserForm;
use common\models\User;

/* @var $this yii\web\View */

/* @var $user User */
/* @var $model UserForm */

$this->title = 'Редактирование данных пользователя';

$organization = $user->organization;

?>

<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs' => [['label'=>'Профиль', 'url'=>'/profile'], $this->title]]); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Редактирование данных пользователя</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'profile-edit']); ?>

                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

                    <div>
                        <label class="control-label" for="userform-organization_id">Организация</label>
                        <input type="text" class="form-control" value="<?php echo $organization->name ?>" readonly="" aria-invalid="false">
                    </div>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                        <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>