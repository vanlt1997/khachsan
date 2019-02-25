<?php
/**
 * Created by PhpStorm.
 * User: Le Van
 * Date: 1/26/2019
 * Time: 4:25 PM
 */

namespace App\Service;


use App\Models\Room;

class RoomService
{
    protected $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function getListRoomByID($id)
    {
        return $this->room->where(['type_room_id' => $id]);
    }

    public function create($id, $room)
    {
        return $this->room->create([
            'type_room_id' => $id,
            'name' => $room->name,
            'status_id' => $room->status,
            'description' => $room->description
        ]);
    }
}
