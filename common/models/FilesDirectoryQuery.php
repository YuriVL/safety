<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FilesDirectory]].
 *
 * @see FilesDirectory
 */
class FilesDirectoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return FilesDirectory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FilesDirectory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
