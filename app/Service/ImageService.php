<?php

namespace App\Service;

use App\Models\Image;
use App\Models\ImageTypeRoom;

class ImageService
{
    protected $image;
    protected $imageTypeRoom;
    protected $imageService;

    public function __construct(Image $image, ImageTypeRoom $imageTypeRoom, \App\Models\ImageService $imageService)
    {
        $this->image = $image;
        $this->imageTypeRoom = $imageTypeRoom;
        $this->imageService = $imageService;
    }

    public function create($imageInput)
    {
        return $this->image->create([
            'url' => $imageInput
        ]);
    }

    public function getImages()
    {
        return $this->image->all();
    }

    public function delete($id)
    {
        return $this->image->find($id)->delete();
    }

    public function saveImageTypeRoom($idTypeRoom, $images)
    {
        $this->imageTypeRoom->whereTypeRoomId($idTypeRoom)->delete();
        if ($images !== null) {
            $images = explode(',', $images);
            foreach ($images as $image) {
                $image = $this->image->whereUrl($image)->first();
                $this->imageTypeRoom->create([
                    'type_room_id' => $idTypeRoom,
                    'image_id' => $image->id
                ]);
            }
        }
    }

    public function getImagesFooter()
    {
        return $this->getImages()->take(6);
    }

    public function saveImageService($id, $images)
    {
        $this->imageService->whereServiceId($id)->delete();
        if ($images !== null) {
            $images = explode(',', $images);
            foreach ($images as $image) {
                $image = $this->image->whereUrl($image)->first();
                $this->imageService->create([
                    'service_id' => $id,
                    'image_id' => $image->id
                ]);
            }
        }
    }

}
