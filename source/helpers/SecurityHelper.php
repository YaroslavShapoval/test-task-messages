<?php

namespace source\helpers;

class SecurityHelper
{
    public static function generateRandomBytes($length = 32)
    {
        if (!extension_loaded('mcrypt')) {
            throw new \InvalidArgumentException('The mcrypt PHP extension is not installed.');
        }
        $bytes = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);

        if ($bytes === false) {
            throw new \Exception('Unable to generate random bytes.');
        }

        return $bytes;
    }

    public static function generateRandomKey($length = 32)
    {
        $bytes = self::generateRandomBytes($length);

        return strtr(mb_substr(base64_encode($bytes), 0, $length, '8bit'), '+/=', '_-.');
    }
}