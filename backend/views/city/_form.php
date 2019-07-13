<?php
use yii\widgets\ActiveForm;
use yii\helpers\{Html, ArrayHelper};
use common\models\{City, Region};
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'idcountry')->dropDownList(City::$countries) ?>

    <?= $form->field($model, 'idregion')->widget(Select2::class, [
        'data' => ArrayHelper::map(Region::getAllRegions(), 'id', 'nameru'),
        'initValueText' => true
    ])->label(false); ?>

    <?= $form->field($model, 'nameru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nameen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(City::statuses()) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
