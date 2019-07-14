<?php
use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;
use common\models\{User, Organization};
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $create boolean*/
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php
    if($create){
        echo $form->field($model, 'password')->passwordInput() ;
    }

    ?>

    <?= $form->field($model, 'name_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_short')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organization_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(Organization::getAllOrganizations(), 'id', 'name'),
        'initValueText' => true
    ]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documents_to')->widget(DatePicker::class, [
        'name' => 'documents_to',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(User::statuses()) ?>

    <?= $form->field($model, 'roles')->dropDownList(User::getAvailableRoles(), ['id' => 'role-selection']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
