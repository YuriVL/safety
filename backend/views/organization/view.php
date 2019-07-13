<?php
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\{Organization,City};

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$statuses = Organization::statuses();
$parents = ArrayHelper::map(Organization::getAllOrganizations(),'id', 'name');
$cities = ArrayHelper::map(City::getAllCities(),'id', 'nameru');
?>
<div class="organization-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hash',
            'name',
            'name_full',
            [
                'attribute' => 'city_id',
                'value' => function ($model) use ($cities) {
                    return $cities[$model->city_id];
                }
            ],
            'address',
            'phone',
            'is_cci',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) use ($parents) {
                    return $parents[$model->parent_id];
                }
            ],
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
        ],
    ]) ?>

</div>
