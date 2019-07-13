<?php
namespace frontend\widgets;

use Yii;
use common\models\News;
use yii\base\Widget;
use yii\helpers\{Html, HtmlPurifier};

class NewsBlock extends Widget
{
    const ANNONCE = 1;
    const FULL = 2;

    public $title = 'Новости';

    public $news;

    public $count = 4;

    public $organization;

    public $user;

    public $type = self::ANNONCE;

    public $htmlPurifierOptions = [
        'HTML.SafeIframe' => true,
        'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
        'URI.SafeIframeRegexp' =>
            '%^(https?:)?//(www.youtube.com/embed/|player.vimeo.com/video/|vk.com/video)%',
    ];

    public function init()
    {
        parent::init();
        if(empty($this->user)){
            $this->user = \Yii::$app->user->getIdentity();
        }
        if(empty($this->organization)){
            $this->organization = $this->user->organization;
        }

        $this->news = News::getList($this->count, $this->organization->id);
    }

    public function run()
    {

        if($this->type == self::ANNONCE){
            return $this->announceNews();
        } else {
            return $this->fullNews();
        }

    }

    private function announceNews() {
        /** @var News $model */
        $content = '';
        foreach ($this->news as $model) {
            $content .= Html::beginTag('article', ['class' => "news-view"]);
            $content .= Html::beginTag('div', ['class' => "panel panel-default"]);

            //head
            $content .= Html::beginTag('div', ['class' => "panel-heading"]);
            $content .= Html::tag('h4', Html::a($model->title, ['/news', ['id'=>$model->id]]));
            $content .= Html::tag('time', Yii::$app->formatter->asDatetime($model->created_at),
                [
                    'datetime' => Yii::$app->formatter->asDatetime($model->created_at, 'php:c'),
                    'class' => 'badge',
                    'pubdate' => 'pubdate',
                ]);
            $content .= Html::endTag('div');
            //body
            $content .= Html::beginTag('div', ['class' => "panel-body"]);
            $content .= Html::beginTag('div', ['class' => "news-content"]);
            $content .= HtmlPurifier::process($model->annonce, $this->htmlPurifierOptions)
                .Html::a('Подробнее', ['/news', ['id'=>$model->id]]);
            $content .= Html::endTag('div') . Html::endTag('div');


            $content .= Html::endTag('div') . Html::endTag('article');

        }

        return $content;
    }

    private function fullNews() {
        /** @var News $model */
        $content = '';
        foreach ($this->news as $model) {
            $content .= Html::beginTag('article', ['class' => "news-view"]);
            $content .= Html::beginTag('div', ['class' => "panel panel-default"]);
            //head
            $content .= Html::beginTag('div', ['class' => "panel-heading"]);
            $content .= Html::tag('h1', $model->title);
            $content .= Html::endTag('div');
            //body
            $content .= Html::beginTag('div', ['class' => "panel-body"]);
            $content .= Html::beginTag('div', ['class' => "news-content"]);
            $content .= HtmlPurifier::process($model->content, $this->htmlPurifierOptions);
            $content .= Html::endTag('div') . Html::endTag('div');
            //footer
            $content .= Html::beginTag('div', ['class' => "panel-footer"]);
            $content .= Html::tag('time', Yii::$app->formatter->asDatetime($model->created_at),
                [
                    'datetime' => Yii::$app->formatter->asDatetime($model->created_at, 'php:c'),
                    'class' => 'badge',
                    'pubdate' => 'pubdate',
                ]);
            $content .= Html::endTag('div');

            $content .= Html::endTag('div') . Html::endTag('article');

        }

        return $content;
    }
}
