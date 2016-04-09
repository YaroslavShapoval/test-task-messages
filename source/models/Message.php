<?php

namespace source\models;

use source\core\BaseModel;

/**
 * Class Message
 * @package source\models
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property integer $created_time
 * @property integer $is_edited
 */
class Message extends BaseModel
{
    static $table_name = 'test_messages';
}