<?php
use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;
use common\models\FilesDirectory;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\FilesDirectory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-directory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'parent_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(FilesDirectory::getAllDirectories(), 'id', 'title'),
        'options' => ['placeholder' => 'Выберите директорию'],
        'initValueText' => true
    ])?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(FilesDirectory::statuses()) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редкатировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
