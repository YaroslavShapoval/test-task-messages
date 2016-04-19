<?php

namespace source\models;

use source\core\BaseModel;
use source\helpers\SecurityHelper;

/**
 * Class Message
 * @package source\models
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property string $image_path
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_edited
 */
class Message extends BaseModel
{
    public $image = null;

    const IMAGE_PATH = __DIR__.'/../../public/images/';

    const IMAGE_MAX_WIDTH = 320;
    const IMAGE_MAX_HEIGHT = 240;

    static $statuses = [
        'UNAPPROVED' => 0,
        'APPROVED'   => 10,
        'DECLINED'   => 20,
    ];

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

    public function validate()
    {
        if (!in_array($this->status, self::$statuses)) {
            $this->errors->add('status', "should be within allowed values");
        }
    }

    public function save($validate = true)
    {
        if ($this->is_invalid()) {
            return $this->errors->to_array();
        }

        if (isset($_FILES['image']) && !empty($imageFile = $_FILES['image']) && !empty($imagePath = $this->uploadImage($imageFile))) {
             $this->image_path = $imagePath;
        }

        if (!$this->errors->is_empty()) {
            return $this->errors->to_array();
        }

        return parent::save($validate);
    }

    protected function uploadImage($imageFile)
    {
        $imageSizeInfo  = getimagesize($imageFile['tmp_name']);

        if (empty($imageSizeInfo)) {
            $this->errors->add('image', 'Wrong file type');

            return false;
        }

        $imageType = $imageSizeInfo['mime'];

        $image = new \Imagick($imageFile['tmp_name']);

        if ($imageSizeInfo[0] > self::IMAGE_MAX_WIDTH || $imageSizeInfo[1] > self::IMAGE_MAX_HEIGHT) {
            if ($imageType == 'image/gif') {
                // Resize each frame
                $image = $image->coalesceImages();

                foreach ($image as $frame) {
                    $frame->resizeImage(self::IMAGE_MAX_WIDTH, self::IMAGE_MAX_HEIGHT, \Imagick::FILTER_LANCZOS, 1, TRUE);
                }

                $image = $image->deconstructImages();
            } else {
                $image->resizeImage(self::IMAGE_MAX_WIDTH, self::IMAGE_MAX_HEIGHT, \Imagick::FILTER_LANCZOS, 1, TRUE);
            }
        }

        $filename = SecurityHelper::generateRandomKey(15) . image_type_to_extension($imageSizeInfo[2]);

        if ($image->writeImages(self::IMAGE_PATH . $filename, true)) {
            return $filename;
        }

        return false;
    }
}