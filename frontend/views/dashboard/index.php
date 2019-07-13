<?php
/* @var $this yii\web\View */

/* @var $user \common\models\User */

use frontend\widgets\NewsBlock;

$organization = $user->organization;

$this->title = 'Личный кабинет пользователя';
?>

<div class="container">
    <div class="row">
        <?php //TODO: Виджет новости?>
        <div class="col-lg-5">
            <div class="panel panel-default">
            <div class="panel-heading">
                Новости
            </div>
            </div>
                <?php echo NewsBlock::widget([
                    'user'=>$user,
                    'organization' => $organization
                ]); ?>
        </div>
        <?php //файловый менеджер ?>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Документы по охране труда
                </div>
                <div class="panel-body">
                    <div id="tree" data-directory="<?php echo $organization->hash?>"></div>
                </div>
            </div>
        </div>
        <?php //TODO: Виджет Персональный менеджер?>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ваш персональный консультант
                </div>
                <div class="panel-body">
                    <div class="a-manager-info">
                        <h3 class="a-manager-info__name">Николай</h3>
                        <div class="a-manager-info__contacts">
                            <a class="a-social a-social_phone" href="tel:+375 (222) 77 80 31" target="_blank">
                                +375 (222) 77 80 31</a><a class="a-social a-social_email" href="mailto:killman.instruct@gmail.com"
                                                     target="_blank">killman.instruct@gmail.com</a>
                            <a class="a-social a-social_skype" href="skype:Pro101safety" target="_blank">Pro101safety</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
