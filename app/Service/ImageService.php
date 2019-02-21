<?php

namespace App\Service;

use App\Models\Image;

class ImageService
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
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
}
