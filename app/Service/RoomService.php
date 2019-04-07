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
            $this->actionCreateOrUpdate($room, $id);
            $this->updateTypeRoom($id);
        });
    }

    public function actionCreateOrUpdate($room, $idTypeRoom, $idRoom = null)
    {
        $action = $this->find($idRoom)?? new Room();
        $action->type_room_id = $idTypeRoom;
        $action->name = $room->name;
        $action->status_id = $room->status;
        $action->description = $room->description;
        $action->save();
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

    public function rooms()
    {
        return $this->room->groupBy(['id','type_room_id'])->get();
    }
}
