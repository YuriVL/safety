<?php
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\{City, Region};

$regions = ArrayHelper::map(Region::getAllRegions(), 'id', 'nameru');
$statuses = City::statuses();

/* @var $this yii\web\View */
/* @var $model common\models\City */
?>
<div class="city-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'idcountry',
                'value' => function($model) {
                    return ArrayHelper::getValue(City::$countries, $model->idcountry);
                }
            ],
            'idregion',
            [
                'attribute' => 'idregion',
                'value' => function($model) use($regions) {
                    $region = ArrayHelper::getValue($regions, $model->idregion);
                    return $region;
                }
            ],
            'nameru',
            'nameen',
            [
                'attribute' => 'status',
                'value' => function ($model) use ($statuses) {
                    return $statuses[$model->status];
                }
            ],
        ],
    ]) ?>

</div>
