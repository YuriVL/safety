<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Организациям';
?>
<div class="affiliates-first">
    <div class="container">
        <div class="row">
            <div class="col col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-10 col-sm-11 col-lg-12">
                        <h1 class="page-title">
                            Охрана труда on-line
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-text">
                            Инструкции по охране труда, приказы, должностные и рабочие инструкции, планы мероприятий и прочее – всего более 50 документов, более 1000 страниц, разработанных с учетом специфики именно вашей организации и все это в вашем личном кабинете.
                        </div>
                    </div>
                </div>
                <div class="row buttons">
                    <div class="col-md-3 col-sm-6 col-lg-5">
                        <a href="#registration">
                            <button class="btn transparent">Зарегистрироваться</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col col-lg-4 col-lg-offset-1 visible-lg">
                <img class="img-responsive"
                     src="https://mogilevcci.by/assets/files/images/resources/14/8.jpg"
                     alt=""></div>
        </div>
    </div>
    <style>
        label.control-label {
            left: 40px;
        }
    </style>
    <div class="container-fluid">
        <div class="adv-carousel-wrapper col-md-12">
            <div class="adv-slider">
                <div class="carousel-item">Профессиональный аудит и консультирование</div>
                <div class="carousel-item">Разработка полного комплекта документов</div>
                <div class="carousel-item">Сопровождение по вопросам охраны труда</div>
            </div>
            <div class="carousel-nav adv-carousel-nav">
                <div class="nav-numbers">
                    <span class="first">
                        01
                    </span>
                    <span class="last-block">
                        /<span class="last">03</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
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
                            Регистрируйтесь и получите полный комплекс услуг в сфере охраны труда
                        </div>
                    </div>
                </div>
                <?php echo $this->render('_signup_form', ['model'=>$model])?>
            </div>
        </div>
    </div>

</div>