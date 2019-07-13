<?php
/* @var $this yii\web\View */
/* @var $hash string | null */

$this->title = "Файловый менеджер";

?>

<div class="row">
    <div class="col-xs-12">
        <?php
        echo \backend\models\helpers\FileManagerFinder::widget([
            'language' => 'ru',
            'target' => $hash,
            'controller' => 'file-manager-elfinder',
            'frameOptions' => ['style'=>'min-height: 500px; width: 100%'],
        ]);
        ?>
    </div>
</div>
