<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerJsFile( 'https://api-maps.yandex.ru/2.1/?apikey=3a5a9f21-e4ea-4cc4-91d9-5d9436ec5e5e&lang=ru_RU',   ['depends' => ['\yii\web\JqueryAsset']]) ;

$this->registerJsFile(
    Yii::$app->request->baseUrl . 'app/js/map.js',
    ['depends' => ['\yii\web\JqueryAsset']]
) ;

$this->title = 'Контакты';
?>
<div class="contacts">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
    <div class="address">
        <div id="map"></div>


        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="contacts-block">
                        <div class="row">
                            <div class="col-md-12 margin-bottom">
                                <div class="contacts__label">
                                    Адрес:
                                </div>
                                <div class="contacts__text">
                                    Республика Беларусь, 212022, г. Могилев, ул. Циолковского , д.1
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="contacts__label">
                                    Телефон:
                                </div>
                                <div class="contacts__text">
                                    <a href="tel:+375222778031">+375 (222) 77 80 31</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="contacts__label">
                                    Емайл:
                                </div>
                                <div class="contacts__text">
                                    <a href="mailto:info.mogilev@cci.by">info.mogilev@cci.by</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>