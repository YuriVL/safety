<?php

use yii\widgets\DetailView;
use common\models\{
    News, Organization, User
};

/* @var $this yii\web\View */
/* @var $model common\models\News */
$statuses = News::statuses();
?>
<div class="news-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'annonce:ntext',
            'content:ntext',
            [
                'attribute' => 'status',
                'value' => function ($model) use ($statuses) {
                    return $statuses[$model->status];
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    $user = User::findOne($model->user_id);
                    return $user->username;
                }
            ],
            [
                'attribute' => 'organizations',
                'value' => function ($model) {
                    $organizations = json_decode($model->organizations);
                    if (!empty($organizations)) {
                        $organizations = Organization::getOrganizations(['in', 'id', $organizations]);
                        $organizations = \yii\helpers\ArrayHelper::map($organizations, 'id', 'name');
                        $organizations = implode(', ', $organizations);
                    }
                    return $organizations;
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('d-m-Y H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('d-m-Y H:i:s', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
