<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'name'=>'Охрана труда on-line',
    'modules' => [
        'ticket' => [
            'class'         => ricco\ticket\Module::class,
            'controllerMap' => [
                'ticket' => [
                    'class' => \frontend\controllers\TicketController::class,
                    'viewPath' => '@frontend/views/ticket',
                ],
            ],
            'qq'=>[
                'Вопрос по работе с приложением' => 'Вопрос по работе с приложением',
                'Вопрос по документации'     => 'Вопрос по документации',
                'Вопрос службе тех.поддержки'     => 'Вопрос службе тех.поддержки',
                'Другое'            => 'Другое',
            ],
            'mailSend' => true,
            'subjectAnswer' => 'Уведомление с веб приложения охрана труда Online'
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=> [
                //site
                ['pattern' => "login", 'route' => "site/login"],
                ['pattern' => "logout", 'route' => "site/logout"],
                ['pattern' => "organization", 'route' => "site/organization"],
                ['pattern' => "how", 'route' => "site/how"],
                ['pattern' => "request-password-reset", 'route' => "site/request-password-reset"],
                ['pattern' => "signup", 'route' => "site/signup"],
                ['pattern' => "verify-email", 'route' => "site/verify-email"],
                ['pattern' => "contact", 'route' => "site/contact"],
                ['pattern' => "reset-password", 'route' => "site/reset-password"],
                ['pattern' => "request-password-reset", 'route' => "site/request-password-reset"],

                //dashboard
                ['pattern' => "dashboard", 'route' => "dashboard/index"],
                ['pattern' => "news", 'route' => "dashboard/news"],
                ['pattern' => "docs", 'route' => "dashboard/docs"],
                ['pattern' => "profile", 'route' => "dashboard/profile"],
                ['pattern' => "profile-edit", 'route' => "dashboard/profile-edit"],
                ['pattern' => "change-password", 'route' => "dashboard/change-password"],

                ['pattern' => "ticket", 'route' => "ticket/ticket/index"],
                // Default
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>' => '<controller>/index',
                ],
        ],
    ],
    'params' => $params,
];
