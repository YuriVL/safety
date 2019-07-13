<?php

use yii\helpers\Html;

/** @var \common\models\User $user */
$user = \Yii::$app->user->getIdentity();
$organization = $user->organization;

$menuItems = [
    ['label' => 'Профиль', 'url' => ['profile']],
    ['label' => 'Выйти', 'url' => ['Выйти']]
];

echo Html::beginTag('li', ['class' => 'dropdown']);

$b_profile = Html::tag('div',
        Html::tag('div', '(' . $user->id . ') ' . $user->username, ['class' => 'b-profile__name']) .
        Html::tag('div', 'Организация: ' . $organization->name, ['class' => 'b-profile__line']) ,
        //Html::tag('div', 'Сообщения: 2', ['class' => 'b-profile__line']),
        ['class' => 'b-profile']) . Html::tag('span', '', ['class' => 'caret']);
echo Html::a($b_profile, '#', ['data-toggle' => 'dropdown']);
echo Html::beginTag('ul', ['class' => 'dropdown-menu']);
echo Html::tag('li', Html::a('Профиль', 'profile', ['tabindex' => '-1']));
echo Html::tag('li', Html::a('Выйти', 'logout', ['tabindex' => '-1', 'data-method' => 'post']));
echo Html::endTag('ul');
echo Html::endTag('li');

