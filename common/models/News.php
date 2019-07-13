<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "tbl_news".
 *
 * @property int $id
 * @property string $title
 * @property string $annonce
 * @property string $content
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 * @property int $organizations
 *
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $uploadTempPath;
    public $imageGetTempUrl;

    public $imageUploadPath = '@frontend/web/images/news';
    /**
     * @var string
     */
    public $imageGetUrl = '/images/news/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    public function init()
    {
        if (empty($this->imageUploadPath)) {
            throw new InvalidConfigException('The "imageUploadPath" property must be set.');
        }
        if (empty($this->imageGetUrl)) {
            throw new InvalidConfigException('The "imageGetUrl" property must be set.');
        }

        $this->imageGetTempUrl = $this->imageGetUrl . 'tmp/';
        $this->uploadTempPath = Yii::getAlias($this->imageUploadPath) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;

        if (!is_dir($this->uploadTempPath)) {
            if (!mkdir($this->uploadTempPath, 0777, true)) {
                throw new \Exception("can't create directory " . $this->uploadTempPath);
            }
        }

        parent::init();

        return $this->removeOldTempFiles();
    }

    private function removeOldTempFiles()
    {
        $imageUploadPath = $this->uploadTempPath;
        if (!empty($imageUploadPath) && is_dir($imageUploadPath)) {
            $scandir = scandir($imageUploadPath);
            $dayAgo = time() - 60 * 60 * 24;
            foreach ($scandir as $dirName) {
                if ($dirName == '.' || $dirName == '..') {
                    continue;
                }
                if (filemtime($imageUploadPath . $dirName) < $dayAgo) {
                    if (is_dir($imageUploadPath . $dirName)) {
                        FileHelper::removeDirectory($imageUploadPath . $dirName);
                    } else {
                        unlink($imageUploadPath . $dirName);
                    }
                }
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public static function statuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активна',
            self::STATUS_NOT_ACTIVE => 'Не активна'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'annonce', 'content'], 'required'],
            [['annonce', 'content'], 'string'],
            [['annonce'], 'string', 'max' => 1000],
            [['content'], 'string', 'max' => 30000],
            [['status', 'user_id'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_NOT_ACTIVE],
            [['status'], 'in', 'range' => array_keys(self::statuses())],
            [['created_at', 'updated_at', 'user_id', 'organizations'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'annonce' => 'Анонс',
            'content' => 'Контент',
            'status' => 'Статус',
            'created_at' => 'Дата публикации',
            'updated_at' => 'Последнее обновление',
            'user_id' => 'Пользователь',
            'organizations' => 'Организации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            if (!Yii::$app->user->id) {
                return false;
            }
            $this->user_id = Yii::$app->user->id;
        } else {
            $this->annonce = $this->imageShift($this->annonce);
            $this->content = $this->imageShift($this->content);
        }
        if (!$this->annonce || !$this->content) {
            return false;
        }

        if (!empty($this->organizations)) {
            $this->organizations = json_encode($this->organizations);
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            //когда узнали id обновляем данные, beforeSave вызовет $this->imageShift();
            $this->save();
        }
    }

    /**
     * Парсит переданный html код, находит картинки находящиеся во временной директории,
     * переносит файлы в директориюю с названием id новости и правит линки на эти файлы.
     * Возвращает обработанный html.
     * @param $html
     * @return string
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function imageShift($html)
    {
        $pregQuoteTempUrl = preg_quote($this->imageGetTempUrl, '/');
        $pattern = '/<\\s?img(?:\\s[^<>]*?)?\\bsrc\\s*=\\s*(?|"([^"]*' . $pregQuoteTempUrl
            . '[^"]*)"|\'([^\']*' . $pregQuoteTempUrl . '[^\']*)\'|([^<>\'"\\s]*))[^<>]*>/i';

        if (preg_match_all($pattern, $html, $matches)) {
            if (!is_dir($this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id)) {
                if (!FileHelper::createDirectory($this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id, 0755, true)
                ) {
                    throw new \Exception("can't create directory " . $this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id);
                }
            }

            foreach ($matches[1] as $image) {
                $filename = basename($image);
                if (!empty($filename) && file_exists($this->uploadTempPath . $filename)) {
                    if (!rename($this->uploadTempPath . $filename,
                        $this->imageUploadPath . DIRECTORY_SEPARATOR . $this->id . DIRECTORY_SEPARATOR . $filename)
                    ) {
                        throw new \Exception("can't create file " . $this->imageUploadPath . DIRECTORY_SEPARATOR
                            . $this->id . DIRECTORY_SEPARATOR . $filename);
                    }
                }
            }

            $newHtml = str_replace($this->imageGetTempUrl, $this->imageGetUrl . $this->id . '/', $html);
            return $newHtml;
        } else {
            return $html;
        }
    }

    public static function getList($limit = 4, $organization_id = null)
    {
        $query = self::find()->where(['organizations' => '']);
        $query->orFilterWhere(['like', 'organizations', $organization_id]);
        $query->limit = $limit;
        $query->orderBy = ['updated_at' => SORT_DESC];
        return $query->active()->all();
    }
}
