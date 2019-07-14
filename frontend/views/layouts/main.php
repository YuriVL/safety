<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page-wrapper">
    <header>
        <div class="container">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img("/app/img/logo.png"),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
                'headerContent' => Html::tag('span', 'Белорусская <br> торгово-промышленная палата <br>Могилевское отделение')
            ]);
            $menuItems = [
                ['label' => 'Главная', 'url' => ['/']],
                ['label' => 'Организациям', 'url' => ['/organization']],
                ['label' => 'Как это работает', 'url' => ['/how']],
                ['label' => 'Контакты', 'url' => ['/contact']],
            ];
            if (!Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Кабинет', 'url' => ['dashboard/index']];
            }
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav'],
                'items' => $menuItems,
            ]);
            echo Html::beginTag('div', ['class' => 'col-xs-4 col-sm-2 col-md-2 pull-right btn-wrapper']);
            if (Yii::$app->user->isGuest) {
                echo Html::a('Вход', ['/login'], ['class' => 'btn-sm btn orange pull-right']);
            } else {
                echo Html::submitButton(
                    Html::a('Выход', ['/logout'], ['data-method' => 'post']),
                    ['class' => 'btn-sm btn orange pull-right']
                );
            }
            echo Html::endTag('div');
            NavBar::end();
            ?>
        </div>
    </header>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <img src="./app/img/logo.png" alt="" class="footer-logo">
                </div>
                <div class="col-md-4 col-sm-6 copyright">
                    (C)<?= date('Y') ?> Все права защищены <br> УП Могилевское отделение БелТПП
                </div>
                <div class="col-md-4 col-sm-6">
                    Республика Беларусь, 212022, г. Могилев, ул. Циолковского , д.1
                </div>
                <div class="col-md-2 col-sm-7 col-xs-12 social-block">
                    <strong>+375 (222) 77 80 31</strong>
                    <a href="mailto:info.mogilev@cci.by">info.mogilev@cci.by</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
