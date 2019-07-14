<?php
namespace backend\models;

use common\models\User;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class UserForm extends Model
{
    public $id;
    public $username;
    public $name_full;
    public $name_short;
    public $position;
    public $phone;
    public $organization_id;
    public $documents_to;
    public $email;
    public $password;
    public $status;
    public $roles;
    public $created_at;
    public $updated_at;


    private $model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'name_full'], 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],
            [['username', 'name_full', 'name_short', 'position'], 'string', 'min' => 2, 'max' => 255],
            [['documents_to', 'roles'], 'safe'],
            [['phone'], 'string', 'min' => 5, 'max' => 100],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=> User::class, 'filter' => function ($query) {
                if (!$this->getModel()->isNewRecord) {
                    $query->andWhere(['not', ['id'=>$this->getModel()->id]]);
                }
            }],

            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],
            [['status', 'organization_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'username' => 'Имя',
            'email' => 'Email',
            'name_full' => 'Полное имя',
            'name_short' => 'Имя сокращенное',
            'position' => 'Должность',
            'phone' => 'Телефон',
            'organization_id' => 'Организация',
            'documents_to' => 'Срок действия документов',
            'status' => 'Статус',
            'roles' => 'Роль',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @param User $model
     * @return mixed
     */
    public function setModel(User $model)
    {
        $this->id = $model->id;
        $this->username = $model->username;
        $this->name_full = $model->name_full;
        $this->name_short = $model->name_short;
        $this->position = $model->position;
        $this->phone = $model->phone;
        $this->organization_id = $model->organization_id;
        $this->email = $model->email;
        $this->status = $model->status;
        $this->documents_to = $model->documents_to;
        $this->created_at = $model->created_at;
        $this->updated_at = $model->updated_at;
        $this->model = $model;
        $this->roles = ArrayHelper::getColumn(
            Yii::$app->authManager->getRolesByUser($model->getId()),
            'name'
        );
        return $this->model;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        if (!$this->model) {
            $this->model = new User();
        }
        return $this->model;
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $model = $this->getModel();
            $model->username = $this->username;
            $model->username = $this->username;
            $model->name_full = $this->name_full;
            $model->name_short = $this->name_short;
            $model->position = $this->position;
            $model->phone = $this->phone;
            $model->organization_id = $this->organization_id;
            $model->email = $this->email;
            $model->status = $this->status;
            $model->documents_to = $this->documents_to;
            if ($this->password) {
                $model->setPassword($this->password);
            }
            $model->generateAuthKey();
            if (!$model->save()) {
                throw new Exception('Model not saved');
            }
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->getId());
            $roles= !empty($this->roles) ? $this->roles : User::ROLE_CONTENT;
            $auth->assign($auth->getRole($roles), $model->getId());


            return !$model->hasErrors();
        }
        return null;
    }
}
