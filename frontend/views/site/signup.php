<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Регистрация пользователя';
?>
<main class="registration-form-wrapper">
        <div class="container registration" id="registration">
            <div class="row">
                <div class="col-lg-1 col-sm-1">
                    <div class="vertical-text visible-lg">
                        Регистрация
                    </div>
                </div>
                <div class="col-lg-10 col-sm-12">
                    <div class="row">
                        <div class="col-sm-1 visible-md"></div>
                        <div class="col-sm-10 col-lg-12">
                            <div class="h3">
                                Зарегистрируйтесь и будьте всегда с актуальными документами по охране труда
                            </div>
                        </div>
                    </div>

                    <?php echo $this->render('_signup_form', ['model'=>$model]) ?>
                </div>
            </div>
        </div>
</main>