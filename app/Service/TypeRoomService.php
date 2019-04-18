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

    public function createOrUpdate($typeRoom, $id = null)
    {
        $action = $this->typeRoom->find($id) ?? new TypeRoom();
        $action->name = $typeRoom->name;
        $action->people = $typeRoom->people;
        $action->bed = $typeRoom->bed;
        $action->extra_bed = $typeRoom->extra_bed;
        $action->number_room = $typeRoom->number_room;
        $action->acreage = $typeRoom->acreage;
        $action->view = $typeRoom->view;
        $action->price = $typeRoom->price;
        $action->sale = $typeRoom->sale;
        $action->description = $typeRoom->description;
        $action->save();
    }

    public function getItemLast()
    {
        return $this->typeRoom->all()->last();
    }

    public function find($id)
    {
        return $this->typeRoom->find($id);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function getPromotions()
    {
        return $this->typeRoom->orderBy('sale', 'desc')->get();
    }



}
