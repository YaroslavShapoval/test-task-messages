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
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_approved
 * @property integer $is_edited
 */
class Message extends BaseModel
{
    static $table_name = 'test_messages';

    static $validates_presence_of = [
        ['name',  'Please enter your name'],
        ['email', 'Please enter your email address'],
        ['text',  'Please enter message text'],
    ];

    static $validates_size_of = [
        [
            'name',
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
}