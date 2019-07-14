<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\{User, Organization};
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $agree_term;
    public $position;
    public $phone;
    public $organization;
    public $address;
    public $city;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'organization', 'email', 'agree_term'], 'trim'],
            [['email', 'organization', 'city', 'password'], 'required'],
            [['position', 'address'], 'safe'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким email уже зарегистрирован'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'ФИО',
            'email' => 'Email',
            'position' => 'Должность',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'address' => 'Адрес',
            'organization' => 'Название организации',
            'city' => 'Населенный пункт',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $transaction = User::getDb()->beginTransaction();
        try {
            $organization = Organization::getOrganizationByName($this->organization);
            if(!$organization){
                $organization = new Organization();
            }
            $organization->name = $this->organization;
            $organization->name_full = $this->organization;
            $organization->phone = $this->phone;
            $organization->city_id = $this->city;

            if($organization->save()){
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->position = $this->position;
                $user->phone = $this->phone;
                $user->organization_id = $organization->id;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                if($user->save() && $this->sendEmail($user)) {
                    $auth =  Yii::$app->authManager;
                    $auth->assign($auth->getRole(3), $user->getId());
                    $transaction->commit();
                    return true;
                } else {
                    foreach ($user->getErrors() as $attribute=>$err){
                        $this->addError($attribute, implode(',', $err));
                    }
                }
            } else {
                foreach ($organization->getErrors() as $attribute=>$err){
                    $this->addError($attribute, $err);
                }
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-error'],
                'body' => 'Не удалось сохранить пользователя',
            ]);
            return $this->refresh();
        }

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'УП "Могилевское отделение БелТПП" - '.Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Регистрация пользователя в web приложении ' . Yii::$app->name. '')
            ->send();
    }
}
