<?php

/* @var $model \frontend\models\SignupForm */

use yii\helpers\{
    ArrayHelper, Html
};
use yii\bootstrap\ActiveForm;
use common\models\{
    City, Organization
};
use kartik\select2\Select2;

$form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'form-vertical']);
?>

    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'phone')->textInput() ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <?php
                        $model->city = $model->city ?? 4470;
                        echo $form->field($model, 'city')->widget(Select2::class, [
                            'data' => ArrayHelper::map(City::getAllCities(), 'id', 'nameru'),
                            'options' => ['placeholder' => 'Выберите населенный пункт'],
                            'initValueText' => true
                        ]) ?>
                        <?= $form->field($model, 'organization')->textInput() ?>
                        <?= $form->field($model, 'address')->textInput() ?>
                        <?= $form->field($model, 'position')->textInput() ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <?php
                    $checkboxTemplate = '
                                        <label class="checkmark-wrapper">{input}<span class="checkmark" style="top: 10px;"></span>
                                                <div class="checkbox-text"> я принимаю <a href="/terms" target="_blank">условия
                                                    пользовательского соглашения</a></div>{error}
                                            </label>';
                    echo $form->field($model, 'agree_term', [
                        'template' => $checkboxTemplate,
                        'inputOptions' => [
                            'class' => 'checkbox',
                            'type' => 'checkbox'
                        ],
                    ])->label(false);
                    ?>

                </div>


                <div class="col-sm-6 col-md-4 col-xs-12 pull-right">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn orange', 'name' => 'signup-button']) ?>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>