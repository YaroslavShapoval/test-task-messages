<?php

namespace source\models;

use source\core\BaseModel;
use source\core\components\UserInterface;
use source\helpers\SecurityHelper;

/**
 * Class User
 * @package source\models
 *
 * @property integer $id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $is_admin
 */
class User extends BaseModel implements UserInterface
{
    public $password = null;

    static $table_name = 'test_users';

    static $validates_presence_of = [
        ['login',  'Please enter your login'],
        ['name',  'Please enter your name'],
        ['email', 'Please enter your email address'],
    ];

    static $validates_uniqueness_of = [
        ['login'],
        ['email'],
    ];

    static $validates_size_of = [
        [
            'name',
            'within' => [3, 30],
            'too_short' => 'cannot be less then 3 symbols length',
            'too_long' => 'cannot be more then 30 symbols length',
        ],

        [
            'login',
            'within' => [3, 30],
            'too_short' => 'cannot be less then 3 symbols length',
            'too_long' => 'cannot be more then 30 symbols length',
        ],

        [
            'text',
            'within' => [3, 255],
            'too_short' => 'cannot be less then 3 symbols length',
            'too_long' => 'cannot be more then 255 symbols length',
        ],
    ];

    static $validates_format_of = [
        [
            'email',
            'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/',
            'message' => 'should be a real email address',
        ],
    ];

    /**
     * @param $login
     * @return self
     * @throws \ActiveRecord\RecordNotFound
     */
    public static function findByLogin($login)
    {
        return self::find([
            'login' => $login,
        ]);
    }
    
    public function save($validate = true)
    {
        if ($this->password !== null) {
            $this->setPasswordHash();
        }

        return parent::save($validate);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password_hash);
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = SecurityHelper::generateRandomKey();
    }

    protected function setPasswordHash()
    {
        $this->password_hash = $this->generatePasswordHash($this->password);
    }

    public function generatePasswordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
    }
}