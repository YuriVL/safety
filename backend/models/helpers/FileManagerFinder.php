<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26.06.2019
 * Time: 22:21
 */

namespace backend\models\helpers;

use mihaildev\elfinder\ElFinder;
use \Yii;

class FileManagerFinder extends ElFinder
{
    public $target;

    public function init()
    {
        $managerOptions = [];

        if (!empty($this->target))
            $managerOptions['target'] = self::genTargetHash($this->target);

        if (!empty($this->filter))
            $managerOptions['filter'] = $this->filter;

        if (!empty($this->callbackFunction))
            $managerOptions['callback'] = $this->id;

        if (!empty($this->language))
            $managerOptions['lang'] = $this->language;

        if (!empty($this->path))
            $managerOptions['path'] = $this->path;

        if (!empty($this->startPath))
            $managerOptions['#'] = ElFinder::genPathHash($this->startPath);

        if ($this->multiple)
            $managerOptions['multiple'] = $this->multiple;

        $this->frameOptions['src'] = $this->getManagerUrl($this->controller, $managerOptions);

        if (!isset($this->frameOptions['style'])) {
            $this->frameOptions['style'] = "width: 100%; height: 100%; border: 0;";
        }
    }

    public static function genTargetHash($target)
    {
        return 'l1_' . rtrim(strtr(base64_encode($target), '+/=', '-_.'), '.');
    }
}