<?php
require_once(__DIR__ . '/../helpers.php');

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/backend' . DIRECTORY_SEPARATOR . env('STORAGE_PATH'));

// custom aliases
Yii::setAlias('@backendUrl', env('BACKEND_URL'));
Yii::setAlias('@frontendUrl', env('FRONTEND_URL'));
Yii::setAlias('@storageUrl', env('BACKEND_URL')). '/backend' . DIRECTORY_SEPARATOR . env('STORAGE_PATH');

Yii::setAlias('@img', '@backendUrl/images');
Yii::setAlias('@js', '@backendUrl/js');
