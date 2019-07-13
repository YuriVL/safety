<?php
/* @var $this yii\web\View */

/* @var $user \common\models\User */

use frontend\widgets\NewsBlock;

$organization = $user->organization;

$this->title = 'Новости';
?>

<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs'=>[$this->title]]); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php echo NewsBlock::widget([
                'user'=>$user,
                'organization' => $organization,
                'count'=>20,
                'type' => NewsBlock::FULL
            ]); ?>
        </div>
    </div>
</div>