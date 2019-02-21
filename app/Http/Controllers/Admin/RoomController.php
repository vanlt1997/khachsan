<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoomRequest;
use App\Service\RoomService;
use App\Service\StatusService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    protected $roomService;
    protected $statusService;

    public function __construct(RoomService $roomService, StatusService $statusService)
    {
        $this->roomService = $roomService;
        $this->statusService = $statusService;
    }

    public function index()
    {
        return view('admin.room.index');
    }

    public function getRoomByTypeRoom($id)
    {
        $idTypeRoom = $id;
        return view('admin.room.room', compact('idTypeRoom'));
    }

    public function getListRoomByTypeRoom($id)
    {
        return DataTables::of($this->roomService->getListRoomByID($id))
            ->addColumn('action', function ($room) use ($id) {
                return
                    '<a href="type-rooms/' . $id . '/rooms/detail/'.$room->id.'" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#typeroom-{$ty}"> <i class="fa fa-info"></i></a>
                    <a href="type-rooms/' . $id . '/rooms/edit/'.$room->id.'" class="btn btn-sm btn-outline-primary"> <i class="fa fa-pencil"></i></a>
                    <a href="type-rooms/' . $id . '/rooms/delete/'.$room->id.'" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make();
    }

    public function createRoom($id)
    {
        $idTypeRoom = $id;
        $status = $this->statusService->getStatus();
        return view('admin.room.form-create', compact('idTypeRoom','status'));
    }

    public function actionCreateRoom($id, RoomRequest $roomRequest)
    {
        $this->roomService->create($id, $roomRequest->all());
        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $id);

    }
}
