<?php
use yii\widgets\ActiveForm;
use yii\helpers\{Html, ArrayHelper};
use common\models\{City, Organization};
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_full')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(City::getAllCities(), 'id', 'nameru'),
        'options' => ['placeholder' => 'Выберите населенный пункт'],
        'initValueText' => true
    ])?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_cci')->dropDownList(Organization::cci()) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(Organization::getAllOrganizations(), 'id', 'name'),
        'options' => ['placeholder' => 'Выберите организацию'],
        'initValueText' => true
    ])?>

    <?= $form->field($model, 'status')->dropDownList(Organization::statuses()) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
