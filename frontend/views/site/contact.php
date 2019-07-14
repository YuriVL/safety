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
                                    <a href="tel:<?php echo env('PHONE') ?? '';?>"><?php echo env('PHONE') ?? '';?>; ?></a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="contacts__label">
                                    Емайл:
                                </div>
                                <div class="contacts__text">
                                    <a href="mailto:<?php echo env('EMAIL')??''; ?>"><?php echo env('EMAIL')??''; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>