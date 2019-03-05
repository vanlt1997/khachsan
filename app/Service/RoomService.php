<?php
/**
 * Created by PhpStorm.
 * User: Le Van
 * Date: 1/26/2019
 * Time: 4:25 PM
 */

namespace App\Service;


use App\Models\Room;
use App\Models\TypeRoom;
use Illuminate\Support\Facades\DB;

class RoomService
{
    protected $room;
    protected $typeRoom;

    public function __construct(Room $room, TypeRoom $typeRoom)
    {
        $this->room = $room;
        $this->typeRoom = $typeRoom;
    }

    public function getListRoomByID($id)
    {
        return $this->room->where(['type_room_id' => $id])
            ->join('status','rooms.status_id','status.id')
            ->select('rooms.*', 'status.name as status_name');
    }

    public function create($id, $room)
    {
        return DB::transaction(function () use ($id, $room){
            $this->actionCreate($id, $room);
            $this->updateTypeRoom($id);
        });
    }

    protected function actionCreate($id, $room)
    {
        return $this->room->create([
            'type_room_id' => $id,
            'name'         => $room->name,
            'status_id'    => $room->status,
            'description'  => $room->description
        ]);
    }

    protected function updateTypeRoom($id)
    {
        $typeRoom = $this->typeRoom->find($id);
        $typeRoom->increment('number_room');
    }

    public function find($id)
    {
        return $this->room->find($id);
    }
}
