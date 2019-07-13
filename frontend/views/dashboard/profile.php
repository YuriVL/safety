<?php
use \yii\helpers\Url;
/* @var $this yii\web\View */

/* @var $user \common\models\User */

$this->title = 'Профиль пользователя';

$organization = $user->organization;

?>

<div class="container">
    <?php echo $this->render("//layouts/_breadcrumbs", ['breadcrumbs'=>[$this->title]]); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">
                        Информация о пользователе
                    </h3>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-xs" href="<?= Url::to(['/profile-edit']) ?>"><i
                                    class="glyphicon glyphicon-pencil"></i> Редактировать</a> <a
                                class="btn btn-primary btn-xs" href="<?= Url::to(['/change-password']) ?>"><i
                                    class="glyphicon glyphicon-lock"></i> Сменить пароль</a></div>
                </div>
                <div class="panel-body2">
                    <table id="w0" class="table detail-view">
                        <tbody>
                        <tr>
                            <th>Имя</th>
                            <td><?php echo $user->username ?></td>
                        </tr>
                        <tr>
                            <th>Организация</th>
                            <td><?php echo $organization->name ?></td>
                        </tr>
                        <tr>
                            <th>Должность</th>
                            <td><?php echo $user->position?></td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td><?php echo $user->phone?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user->email?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>