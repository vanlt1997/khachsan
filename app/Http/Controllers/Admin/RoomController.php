<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoomRequest;
use App\Service\ImageService;
use App\Service\RoomService;
use App\Service\StatusService;
use App\Http\Controllers\Controller;
use App\Service\TypeRoomService;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    protected $roomService;
    protected $statusService;
    protected $imageService;
    protected $typeRoomService;

    public function __construct
    (
        RoomService $roomService,
        StatusService $statusService,
        ImageService $imageService,
        TypeRoomService $typeRoomService
    )
    {
        $this->roomService = $roomService;
        $this->statusService = $statusService;
        $this->imageService = $imageService;
        $this->typeRoomService = $typeRoomService;
    }

    public function index()
    {
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('admin.room.index', compact('typeRooms'));
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
                    '<a href="rooms/'.$room->id.'/detail" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#typeroom-{$ty}"> <i class="fa fa-info"></i></a>
                    <a href="rooms/'.$room->id.'/edit" class="btn btn-sm btn-outline-primary"> <i class="fa fa-pencil"></i></a>
                    <a href="rooms/'.$room->id.'/delete" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make();
    }

    public function create($id)
    {
        $idTypeRoom = $id;
        $status = $this->statusService->getStatus();
        $images = $this->imageService->getImages();
        return view('admin.room.form', compact('idTypeRoom', 'status', 'images'));
    }

    public function actionCreate($id, RoomRequest $roomRequest)
    {
        $this->roomService->create($id, $roomRequest);

        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $id)->with('message', 'Create Room Successfully !');
    }

    public function edit($id, $roomId)
    {
        $room = $this->roomService->find($roomId);
        $status = $this->statusService->getStatus();

        return view('admin.room.form', compact('room', 'status'));
    }

    public function actionEdit($id, $roomId, RoomRequest $request)
    {
        $this->roomService->actionCreateOrUpdate($request, $id, $roomId);

        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $id)->with('message', 'Update Room Successfully !');
    }

    public function delete($id, $roomId)
    {

    }
}
