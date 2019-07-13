<?php

namespace common\models;

use Yii;
use yii\behaviors\{
    SluggableBehavior, TimestampBehavior
};

/**
 * This is the model class for table "{{%files_directory}}".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $comment
 * @property int $parent_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class FilesDirectory extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%files_directory}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['slug'], 'unique'],
            [['comment'], 'string'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => ['id', 'title'],
                'ensureUnique' => true,
                'immutable' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Обозначение',
            'title' => 'Название',
            'comment' => 'Комментарий',
            'parent_id' => 'Родитель',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FilesDirectoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilesDirectoryQuery(get_called_class());
    }

    /**
     * Returns user statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активна',
            self::STATUS_DISABLED => 'Отключена',
        ];
    }

    public static function getAllDirectories()
    {
        $query = self::find();
        return self::getDb()->cache(function () use ($query) {
            return $query->all();
        });
    }

    public static function getDirectoriesByParent($parent_id = null)
    {
        $query = self::find()->where(['parent_id' => $parent_id]);
        return self::getDb()->cache(function () use ($query) {
            return $query->all();
        });
    }
}
