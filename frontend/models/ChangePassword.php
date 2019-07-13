<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 11.07.2019
 * Time: 0:02
 */

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;


class ChangePassword extends Model
{
    public $password;
    public $newPassword;
    public $credentialPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password','newPassword', 'credentialPassword'], 'required'],
            [['password', 'newPassword', 'credentialPassword'], 'string', 'min' => 6],
            ['password', 'validatePassword', 'skipOnEmpty' => false],
            ['credentialPassword', 'validateCredentialPassword', 'skipOnEmpty' => false]
        ];
    }


    public function validateCredentialPassword($attribute, $params)
    {
        $credentialPassword = $this->$attribute;
        $newPassword = $this->newPassword;

        if ($newPassword != $credentialPassword) {
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

    public function validatePassword($attribute, $params)
    {
        /** @var \common\models\User $user */
        $user = \Yii::$app->user->getIdentity();

        if (!$user || !$user->validatePassword($this->$attribute)) {
            $this->addError($attribute, 'Введен неверный пароль');
        }
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function changeUserPassword()
    {
        $user = \Yii::$app->user->getIdentity();
        $user->setPassword($this->newPassword);
        return $user->save(false);
    }
}