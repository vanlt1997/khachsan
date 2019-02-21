<?php
/**
 * Created by PhpStorm.
 * User: Le Van
 * Date: 2/4/2019
 * Time: 7:38 PM
 */

namespace App\Service;


use App\Models\ImageTypeRoom;

class ImageTypeRoomService
{
    protected $imageTypeRoom;

    public function __construct(ImageTypeRoom $imageTypeRoom)
    {
        $this->imageTypeRoom = $imageTypeRoom;
    }
}
