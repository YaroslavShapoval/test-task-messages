<?php

namespace source\controllers;

use source\core\BaseController;
use source\core\components\UserComponent;
use source\models\User;

class LoginController extends BaseController
{
    protected $errors = [];

    public function actionIndex()
    {
        return $this->render('login/index');
    }

    public function actionValidate()
    {
        if (!$this->validate()) {
            return json_encode($this->errors);
        }

        return '';
    }

    public function actionLogin()
    {
        $user = $this->validate();

        if (!empty($this->errors)) {
            return json_encode($this->errors);
        }

        $userComponent = UserComponent::getInstance();
        $userComponent->storeUserSession($user);

        return '';
    }

    public function actionLogout()
    {
        $userComponent = UserComponent::getInstance();
        $userComponent->destroyUserSession();

        header('Location: /');
    }

    protected function validate()
    {
        $this->errors = [];

        $attributes = $_POST;
        $user = User::findByLogin($attributes['login']);

        if (empty($user)) {
            $this->errors[] = ['Login is incorrect'];

            return false;
        }

        if (!$user->validatePassword($attributes['password'])) {
            $this->errors[] = ['Password is incorrect'];

            return false;
        }

        return $user;
    }
}