<?php
/* @var $this yii\web\View */

/* @var $user \common\models\User */

$this->title = 'Документы по охране труда';

$organization = $user->organization;
?>

<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs'=>[$this->title]]); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Документы по охране труда
                </div>
                <div class="panel-body">
                    <div id="tree" data-directory="<?php echo $organization->hash?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>