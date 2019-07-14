<?php

use yii\widgets\DetailView;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
?>
<div class="user-view">

    <?php
    $statuses = User::statuses();
    $roles = User::getAvailableRoles();

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'name_full',
            'name_short',
            'position',
            'phone',
            [
                'attribute' => 'documents_to',
                'value' => function ($model) {
                    $date = (!empty($model->documents_to)) ? date('d-m-Y', $model->documents_to) : '';
                    return $date;

                }
            ],
            [
                'attribute' => 'organization_id',
                'value' => function ($model) {
                    return $model->model->organization->name;
                }
            ],
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) use ($statuses) {
                    return $statuses[$model->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d-m-Y', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('d-m-Y', $model->updated_at);
                }
            ],
            [
                'attribute' => 'roles',
                'value' => function ($model) use ($roles) {
                    $user_roles = ArrayHelper::getColumn(
                        Yii::$app->authManager->getRolesByUser($model->model->getId()),
                        'name'
                    );
                    foreach ($user_roles as $key => $value) {
                        return $roles[$key];
                    }
                }
            ],
        ],
    ]) ?>

</div>
