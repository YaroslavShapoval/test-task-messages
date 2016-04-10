<?php

namespace source\helpers;

use source\models\Message;

class MessageHelper
{
    public static function getMessageLabel(Message $message)
    {
        $colors = [
            0  => 'warning',
            10 => 'success',
            20 => 'danger',
        ];

        return $colors[$message->status];
    }

    public static function getMessageText(Message $message)
    {
        $colors = [
            0  => 'In Queue',
            10 => 'Approved',
            20 => 'Declined',
        ];

        return $colors[$message->status];
    }
}