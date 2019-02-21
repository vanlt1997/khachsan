<?php

namespace App\Service;


use App\Models\TypeRoom;

class TypeRoomService
{
    protected $typeRoom;

    public function __construct(TypeRoom $typeRoom)
    {
        $this->typeRoom = $typeRoom;
    }

    public function getTypeRooms()
    {
        return $this->typeRoom->all();
    }

    public function create($typeRoom)
    {
        return $this->typeRoom->create([
            'name' => $typeRoom->name,
            'people' => $typeRoom->people,
            'bed' => $typeRoom->bed,
            'extra_bed' => $typeRoom->extra_bed,
            'number_room' => $typeRoom->number_room,
            'acreage' => $typeRoom->acreage,
            'view' => $typeRoom->view,
            'price' => $typeRoom->price,
            'sale' => $typeRoom->sale,
            'description' => $typeRoom->description
        ]);
    }

    public function getItemLast()
    {
        return $this->typeRoom->all()->last();
    }
}
