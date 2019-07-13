<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property int $id
 * @property int $idcountry
 * @property string $nameru
 * @property string $nameen
 * @property int $status
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcountry', 'status'], 'integer'],
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
            'idcountry' => 'Idcountry',
            'nameru' => 'Nameru',
            'nameen' => 'Nameen',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionQuery(get_called_class());
    }

    public static function getAllRegions()
    {
        $query = self::find();
        return self::getDb()->cache(function () use($query) {
            return $query->active()->all();
        });
    }
}
