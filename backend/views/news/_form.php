<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\{Html,Url,ArrayHelper};
use common\models\{Organization, News};
use vova07\imperavi\Widget as Imperavi;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */

$imperaviPlugins = [
    'fontsize',
    'fontcolor',
    'table',
    'video',
    'fullscreen',
    'imagemanager',
];
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['id' => 'news-form']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'annonce')->widget(Imperavi::class, [
        'id' => 'imperavi-widget-annonce',
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'maxHeight' => 400,
            'limiter' => 4,
            'imageManagerJson' => Url::to(['/news/files-get']),
            'imageUpload' => Url::to(['/news/files-upload']),
            'imageDelete' => Url::to(['/news/files-delete']),
            'plugins' => $imperaviPlugins
        ]
    ]) ?>

    <?= $form->field($model, 'content')->widget(Imperavi::class, [
        'id' => 'imperavi-widget-content',
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'maxHeight' => 400,
            'imageManagerJson' => Url::to(['/news/files-get']),
            'imageUpload' => Url::to(['/news/files-upload']),
            'imageDelete' => Url::to(['/news/files-delete']),
            'plugins' => $imperaviPlugins
        ]
    ]) ?>

    <?=$form->field($model, 'status')->dropDownList(News::statuses()) ?>

    <?php

    if(!empty($model->organizations)){
        $model->organizations = json_decode($model->organizations);
    }

    echo $form->field($model, 'organizations')->widget(Select2::class, [
        'data' => ArrayHelper::map(Organization::getActiveClientOrganizations(), 'id', 'name'),
        'options' => ['placeholder' => 'Выберите пользователя для отправки новости'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ])?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
