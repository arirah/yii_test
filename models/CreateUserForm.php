<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CreateUserForm extends ActiveRecord
{
    public $first_name;
    public $last_name;
    public $email;
    public $personal_code;
    public $phone;
    public $active;
    public $dead;
    public $lang;
    public $password;
    public $authKey;
    public $accessToken;
    private $_user = false;
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'user';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['first_name', 'password', 'email'], 'required'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'email'],
            [['last_name', 'personal_code', 'phone', 'dead', 'lang'], 'safe'],

        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function addUser()
    {
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->personal_code = $this->personal_code;
        $user->phone = $this->phone;
        $user->active = $this->active?$this->active:1;
        $user->dead = $this->dead;
        $user->lang = $this->lang;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);;
        $user->generateAuthKey();//$user->accessToken = $this->accessToken;
        return $user->save() ? true : false;
    }
}
