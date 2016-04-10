<?php

namespace source\core\components;

use source\core\Object;
use source\models\User;

class UserComponent extends Object
{
    const REMEMBER_DURATION = 86400; // 24 hours

    /**
     * @var null|UserComponent
     */
    protected static $instance = null;

    /**
     * @var null|User
     */
    protected $user = null;

    /**
     * @return null|UserComponent
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return null|User
     */
    public function getUserModel()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function checkUserSession()
    {
        if (!empty($_SESSION['login']) && !empty($_SESSION['auth_key'])) {
            $user = User::findByLogin($_SESSION['login']);

            if ($user->validateAuthKey($_SESSION['auth_key'])) {
                $this->user = $user;

                return true;
            }

            // If session has wrong credentials
            $this->destroyUserSession();
        }

        return false;
    }

    public function storeUserSession(UserInterface $user)
    {
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['auth_key'] = $user->getAuthKey();
    }

    public function destroyUserSession()
    {
        unset($_SESSION['login']);
        unset($_SESSION['auth_key']);

        session_destroy();
    }
}