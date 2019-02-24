<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeRoomRequest;
use App\Http\Controllers\Controller;
use App\Service\ImageService;
use App\Service\TypeRoomService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeRoomController extends Controller
{
    protected $typeRoomService;
    protected $imageService;

    public function __construct(
        TypeRoomService $typeRoomService,
        ImageService $imageService
    )
    {
        $this->typeRoomService = $typeRoomService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        return view('admin.typeroom.index');
    }

    public function test()
    {
        $typeRooms = $this->typeRoomService->getTypeRooms();
        return response()->json($typeRooms);
    }

    public function getListTypeRoom()
    {
        return DataTables::of($this->typeRoomService->getTypeRooms())
            ->addColumn('action', function ($typeroom) {
                return
                    '<a href="type-rooms/' . $typeroom->id . '/detail" class="btn btn-sm btn-outline-warning"> <i class="fa fa-info"></i></a>
                    <a href="type-rooms/' . $typeroom->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="type-rooms/' . $typeroom->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    <a href="type-rooms/' . $typeroom->id . '/rooms" class="btn btn-sm btn-outline-info">Room</a>
                    ';
            })
            ->make();
    }

    public function createTypeRoom(Request $request)
    {
        $images = $this->imageService->getImages();
        return view('admin.typeroom.form-create', compact('images'));
    }

    public function actionCreateTypeRoom(TypeRoomRequest $request)
    {
        $this->typeRoomService->create($request);
        $typeRoom = $this->typeRoomService->getItemLast();
        if ($request->images)
        {
            $this->imageService->saveImageTypeRoom($request->images, $typeRoom->id);
        }
        return redirect()->route('admin.type-rooms.index')->with('message', 'Create TypeRoom Successfully !');
    }

    public function delete($id)
    {
        if ($this->typeRoomService->find($id)->room->isEmpty())
        {
            $this->typeRoomService->delete($id);
            return redirect()->route('admin.type-rooms.index')->with('message', 'Delete TypeRoom Successfully !');
        }
        else
        {
            return redirect()->route('admin.type-rooms.index')->with('error', "You Can't Delete TypeRoom !");
        }

    }

    public function detail($id)
    {
        $typeRoom = $this->typeRoomService->find($id);
        return view('admin.typeroom.detail', compact('typeRoom'));
    }
}
