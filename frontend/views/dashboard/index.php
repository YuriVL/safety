<?php
/* @var $this yii\web\View */

/* @var $user \common\models\User */

use frontend\widgets\NewsBlock;
use common\models\User;
use yii\helpers\Html;

$organization = $user->organization;

$user = User::findOne(1);

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
                'user' => $user,
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
                    <div id="tree" data-directory="<?php echo $organization->hash ?>"></div>
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
                        <h3 class="a-manager-info__name"><?php echo $user->name_full ?></h3>
                        <div class="a-manager-info__contacts">
                            <?php
                            echo Html::a(($user->phone ?? ""), 'tel:' . ($user->phone ?? ""), [
                                'class' => 'a-social a-social_phone',
                                'target' => '_blank',
                            ]);
                            echo Html::a(($user->email ?? ""), 'mailto:' . ($user->email ?? ""), [
                                'class' => 'a-social a-social_email',
                                'target' => '_blank',
                            ]);

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
