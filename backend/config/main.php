<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
        ],
        'ticket' => [
            'class'         => ricco\ticket\Module::class,
            'controllerMap' => [
                'admin' => [
                    'class' => \backend\controllers\TicketController::class,
                    'viewPath' => '@backend/views/ticket',
                ],
            ],
            'qq'=>[
                'Вопрос по работе с приложением' => 'Вопрос по работе с приложением',
                'Вопрос по документации'     => 'Вопрос по документации',
                'Вопрос службе тех.поддержки'     => 'Вопрос службе тех.поддержки',
                'Другое'            => 'Другое',
            ],
            'adminId'=>[1]
        ],
    ],
    'controllerMap' => [
        'file-manager-elfinder' => [
            'class' => backend\controllers\ElfinderController::class,
            //'access' => ['manager', 'admin'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@backendUrl',
                    'basePath' => '@backend',
                    'path' => DIRECTORY_SEPARATOR . env('STORAGE_PATH'),
                    //'access' => ['read' => '*', 'write' => 'admin']
                ]
            ]
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'xxxxxxx',
            //'baseUrl' => '/',
            'web' => '/',
            // 'adminUrl' => '/admin'
            'adminUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ["*"],
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
