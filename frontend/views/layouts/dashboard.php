<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\DashboardAsset;
use common\widgets\Alert;

DashboardAsset::register($this);
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

<div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img("/app/img/logo.png"),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default',
                ]
            ]);
            $menuItems = [
                ['label' => 'Личный кабинет', 'url' => ['/dashboard/index']],
                ['label' => 'Документы', 'url' => ['/docs']],
                ['label' => 'Новости', 'url' => ['/news']],
                ['label' => 'Служба поддержки', 'url' => ['/ticket']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left nav'],
                'items' => $menuItems,
            ]);
            echo Html::beginTag('ul', ['class' => 'navbar-nav navbar-right navbar-profile nav']);
            if (!Yii::$app->user->isGuest) {
                echo $this->render('_profile');
            }
            echo Html::endTag('ul');
            NavBar::end();
            ?>


    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
    <footer class="footer">
        <div class="container-fluid">
            <p class="pull-left">© УП Могилевское отделение БелТПП <?= date('Y') ?> </p>
            <p class="pull-right"><!--? //= Yii::powered() ?--></p>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
