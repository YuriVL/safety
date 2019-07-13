<?php
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use common\models\FilesDirectory;

/* @var $this yii\web\View */
/* @var $model common\models\FilesDirectory */
$statuses = FilesDirectory::statuses();
$parents = ArrayHelper::map(FilesDirectory::getAllDirectories(),'id', 'title');
?>
<div class="files-directory-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'title',
            'comment:ntext',
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
