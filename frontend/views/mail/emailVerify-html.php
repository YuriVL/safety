<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Здравствуйте <?= Html::encode($user->username) ?>,</p>

    <p>Вы зарегистрировались в web-приложении "Охрана труда online" на сайте</p>

    <a href="<?php echo env('FRONTEND_URL') ?>"> УП "Могилевскоt отделения БелТПП"</a>

    <p>Перейдите по следующей ссылке, чтобы подтвердить свой аккаунт</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
