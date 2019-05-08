<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\TypeRoom;
use App\Service\ImageService;
use App\Service\OrderService;
use App\Service\RoomService;
use App\Service\StatusService;
use App\Http\Controllers\Controller;
use App\Service\TypeRoomService;
use Illuminate\Support\Facades\DB;
use Session;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    protected $roomService;
    protected $statusService;
    protected $imageService;
    protected $typeRoomService;

    public function __construct(
        RoomService $roomService,
        StatusService $statusService,
        ImageService $imageService,
        TypeRoomService $typeRoomService
    ) {
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

    public function getRoomByTypeRoom(TypeRoom $typeRoom)
    {
        $idTypeRoom = $typeRoom->id;
        return view('admin.room.room', compact('idTypeRoom'));
    }

    public function getListRoomByTypeRoom(TypeRoom $typeRoom)
    {
        return DataTables::of($this->roomService->getListRoomByID($typeRoom->id))
            ->addColumn('action', function ($room) {
                return
                    '<a href="rooms/'.$room->id.'/detail" class="btn btn-sm btn-outline-warning"> <i class="fa fa-info"></i></a>
                    <a href="rooms/'.$room->id.'/edit" class="btn btn-sm btn-outline-primary"> <i class="fa fa-pencil"></i></a>
                    <a href="rooms/'.$room->id.'/delete" class="btn btn-sm btn-outline-danger"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make();
    }

    public function create(TypeRoom $typeRoom)
    {
        $status = $this->statusService->getStatus();
        $images = $this->imageService->getImages();
        return view('admin.room.form', compact('typeRoom', 'status', 'images'));
    }

    public function actionCreate(TypeRoom $typeRoom, RoomRequest $roomRequest)
    {
        $this->roomService->create($typeRoom->id, $roomRequest);


        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $typeRoom->id)
            ->with('message', 'Create Room Successfully !');
    }

    public function edit(TypeRoom $typeRoom, Room $room)
    {
        $room = $this->roomService->find($room->id);
        $status = $this->statusService->getStatus();

        return view('admin.room.form', compact('room', 'status', 'typeRoom'));
    }

    public function actionEdit(TypeRoom $typeRoom, Room $room, RoomRequest $request)
    {
        $this->roomService->actionCreateOrUpdate($request, $typeRoom->id, $room->id);

        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $typeRoom->id)
            ->with('message', 'Update Room Successfully !');
    }

    public function delete(TypeRoom $typeRoom, Room $room)
    {
        $orderDetails = $room->orderDetails;
        if ($orderDetails->isEmpty()) {
            $this->roomService->delete($typeRoom->id, $room);

            return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $typeRoom->id)
                ->with('message', 'Delete Room Successfully !');
        }

        return redirect()->route('admin.type-rooms.rooms.getRoomByTypeRoom', $typeRoom->id)
            ->with('error', 'Can\'t Delete Room !');
    }
}
