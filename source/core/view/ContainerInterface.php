<?php

namespace source\core\view;

interface ContainerInterface
{
    public function setField($field, $value);
    public function getField($field);
    public function issetField($field);
    public function unsetField($field);
}