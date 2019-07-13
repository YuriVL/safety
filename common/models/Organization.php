<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%organization}}".
 *
 * @property int $id
 * @property string $name
 * @property string $name_full
 * @property int $city_id
 * @property string $address
 * @property string $phone
 * @property int $is_cci
 * @property int $parent_id
 * @property int $hash
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property City $city
 * @property User[] $users
 */
class Organization extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    const IS_CCI = 1;
    const IS_NOT_CCI = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organization}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'is_cci', 'status', 'created_at', 'updated_at'], 'integer'],
            [['city_id', 'name'], 'required'],
            [['name', 'phone'], 'string', 'max' => 100],
            [['name_full'], 'string', 'max' => 150],
            [['address', 'hash'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'Название',
            'name_full' => 'Название полное',
            'city_id' => 'Нас.пункт',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'is_cci' => 'БелТПП?',
            'parent_id' => 'Вышестоящая организация',
            'hash' => 'Хэш',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['organization_id' => 'id']);
    }

    public static function getOrganizationByName($name)
    {
        return self::find()->where(['like', 'name', $name])->one();
    }

    /**
     * {@inheritdoc}
     * @return OrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrganizationQuery(get_called_class());
    }

    public static function getAllOrganizations()
    {
        $query = self::find();
        return self::getDb()->cache(function () use ($query) {
            return $query->all();
        });
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

    /**
     * Returns user statuses list
     * @return array|mixed
     */
    public static function cci()
    {
        return [
            self::STATUS_DISABLED => 'Сторонняя организация',
            self::IS_CCI => 'Филиал БелТПП'
        ];
    }

    public function beforeSave($insert)
    {
        if(empty($this->hash)){
            $this->hash = hash('md5', $this->name . $this->city_id);
        }

        $this->parent_id = $this->parent_id ?? 0;

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $directory = $this->createDirectory($this->hash, \Yii::getAlias('@storage'));

        $directories = FilesDirectory::getDirectoriesByParent();

        foreach ($directories as $subdirectory) {
            /**  @var FilesDirectory $subdirectory */
            $this->createDirectory($subdirectory->slug, $directory, $subdirectory);
        }

    }

    private function createDirectory($slug, $directory, $subdirectory = null)
    {
        $directory = $directory . DIRECTORY_SEPARATOR . $slug;

        if(!empty($subdirectory)){
            /**  @var FilesDirectory $subdirectory */
            $fds = FilesDirectory::getDirectoriesByParent($subdirectory->id);
            if($fds){
                foreach ($fds as $fd) {
                    /**  @var FilesDirectory $fd */
                    $this->createDirectory($fd->slug, $directory, $fd);
                }
            }
        }

        FileHelper::createDirectory($directory);

        return $directory;
    }

    public function beforeDelete()
    {
        $directory = \Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $this->hash;

        FileHelper::removeDirectory($directory);

        $directories = FilesDirectory::getAllDirectories();

        foreach ($directories as $subdirectory) {
            /** @var FilesDirectory $subdirectory */
            $subdirectory = $directory . DIRECTORY_SEPARATOR . $subdirectory->slug;

            FileHelper::removeDirectory($subdirectory);
        }

        return parent::beforeDelete();
    }

    public function getFilesTree()
    {
        $directory = \Yii::getAlias('@storage') . DIRECTORY_SEPARATOR . $this->hash;

        return $this->findList($directory);
    }

    private function findList($directory)
    {
        $files_directory = ArrayHelper::map(FilesDirectory::getAllDirectories(), 'slug', 'title');
        $lists = [];
        $scan = scandir($directory);
        if(!empty($scan)){
            foreach ($scan as $file){
                if($file == '.' || $file == '..'){
                    continue;
                }
                if(is_dir($directory . DIRECTORY_SEPARATOR. $file)){
                    $node = [];
                    $node['text'] = ArrayHelper::getValue($files_directory, $file) ??  $file;
                    $nodes = $this->findList($directory . DIRECTORY_SEPARATOR. $file);
                    if(!empty($nodes)){
                        $node['nodes'] = $nodes;
                    }
                    $lists[] = $node;
                } else {
                    $lists[] = [
                        'text'=>$file,
                        'icon'=> 'glyphicon glyphicon-file',
                        'selectedIcon'=> 'glyphicon glyphicon-file',
                        'href'=>str_replace(\Yii::getAlias('@backend'). DIRECTORY_SEPARATOR . "web",
                            \Yii::getAlias('@storageUrl'), $directory). DIRECTORY_SEPARATOR . $file
                    ];
                }
            }
        }
        return $lists;
    }

    public static function getActiveClientOrganizations()
    {
        $query = self::find();
        return self::getDb()->cache(function () use($query) {
            return $query->where(['is_cci'=>0])->active()->all();
        },60);
    }

    public static function getOrganizations($conditions)
    {
        $query = self::find();
        return self::getDb()->cache(function () use($query, $conditions) {
            return $query->where($conditions)->all();
        }, 60);
    }
}
