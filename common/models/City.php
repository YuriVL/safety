<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property int $idcountry
 * @property int $idregion
 * @property string $nameru
 * @property string $nameen
 * @property int $status
 *
 * @property Organization[] $organizations
 */
class City extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    public static $countries = [
        //1=>'Россия',
        21=>'Беларусь'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcountry', 'idregion', 'status'], 'integer'],
            [['nameru', 'nameen'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcountry' => 'Страна',
            'idregion' => 'Регион',
            'nameru' => 'Название населенного пункта',
            'nameen' => 'Название Eng',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::class, ['city_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }

    public static function getAllCities()
    {
        $query = self::find();
        return self::getDb()->cache(function () use($query) {
            return $query->active()->all();
        });
    }

    /**
     * Returns user statuses list
     * @return array|mixed
     */
    public static function statuses() {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DISABLED => 'Отключен',
        ];
    }
}
