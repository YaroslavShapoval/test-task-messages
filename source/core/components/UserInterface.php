<?php

namespace source\core\components;

interface UserInterface
{
    /**
     * @param $login
     * @return self
     */
    public static function findByLogin($login);

    public function getLogin();

    public function getUsername();

    public function getAuthKey();

    public function validatePassword($password);

    public function validateAuthKey($authKey);

    public function generateAuthKey();
}