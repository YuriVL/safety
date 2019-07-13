<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Web приложение по охране труда';
?>
<main>
    <div class="container-fluid dark">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6 col-md-12">
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
                                Услуги в области охраны труда: Разработка полного комплекта документов по охране труда, СУОТ (СТБ 18001-2009, OHSAS 18001:2007, идентификация опасностей и оценка рисков) в соответствии с требованиями законодательства Республики Беларусь об охране труда; устранение нарушений, выявленных надзорными органами в части документации по охране труда; услуги аутсорсинга по охране труда; услуги комплексного аудита по вопросам охраны труда.
                            </div>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-3 col-sm-6 col-lg-6 mb">
                            <a href="/organization">
                                <button class="btn orange">Организациям</button>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6">
                            <a href="/how">
                                <button class="btn orange">Как это работает</button>
                            </a></div>
                    </div>
                </div>
                <div class="col col-lg-6 visible-lg">
                    <div class="laptop">
                        <img src="./app/img/laptop.png"   alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row about">
            <div class="line"></div>
            <div class="col-md-12">
                <div class="h3">
                    <span class="yellow">Охрана труда on-line</span> - универсальное веб-приложение, для организации более гибкого взаимодействия между нашими специалистами и организациями (индивидуальными предпринимателями) в области охраны труда.
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="line hidden-xs"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-1 visible-md">

                </div>
                <div class="col-lg-6 col-md-10">
                    <div class="h3">
                        Услуги по охране труда:
                    </div>
                    <div class="main-text">
                        <p>1. Разработка полного комплекта документов по охране труда, СУОТ в соответствии с требованиями законодательства Республики Беларусь.</p>

                        <p>2. Устранение нарушений, выявленных надзорными органами в части документации по охране труда.</p>

                        <p>3. Профессиональный аудит и консультирование. </p>

                        <p>4. Сопровождение Вашей организации по вопросам охраны труда (аутсорсинг). </p>
                        <div class="col-lg-9 no-paddings yellow contacts">
                            <div class="left">
                                +375 (222) 77 80 31 info.mogilev@cci.by
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 visible-lg photo">
                    <img src="https://mogilevcci.by/assets/files/images/resources/15/GennadyChorny.jpg"
                         class="phone-left"></div>

            </div>
        </div>
    </div>
    <div class="container registration">
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


</main>
