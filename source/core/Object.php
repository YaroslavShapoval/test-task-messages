<?php

namespace source\core;

class Object
{
    public static function className()
    {
        return get_called_class();
    }
}