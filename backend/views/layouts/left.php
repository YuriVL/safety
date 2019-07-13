<?php

use common\models\User;

$user = \Yii::$app->user->getIdentity();

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/logo.png" class="img-circle" alt=""/>
            </div>
            <div class="pull-left info">
                <p><?php echo $user->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    [
                        'label'=>'Пользователи',
                        'icon' => 'users',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Организации', 'icon' => 'list-alt', 'url' => ['/organization']],
                            ['label' => 'Пользователи', 'icon' => 'user-o', 'url' => ['/user']],
                            ['label' => 'Населенные пункты', 'icon' => 'building', 'url' => ['/city']],
                        ],
                        //'visible' => Yii::$app->user->can(User::ROLE_MANAGER),
                    ],
                    [
                        'label'=>'Документы',
                        'icon' => 'files-o',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Файловый менеджер', 'icon' => 'file', 'url' => ['/file-manager']],
                            ['label' => 'Директории', 'icon' => 'files-o', 'url' => ['/files-directory']],
                        ],
                    ],
                    [
                        'label'=>'Уведомления',
                        'icon' => 'envelope-o',
                        'url' => ['/ticket/admin/index']
                    ],
                    [
                        'label'=>'Новости',
                        'icon' => 'newspaper-o',
                        'url' => ['/news']
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
