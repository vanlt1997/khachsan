<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeRoomRequest;
use App\Http\Controllers\Controller;
use App\Service\DeviceService;
use App\Service\ImageService;
use App\Service\TypeRoomService;
use Yajra\DataTables\DataTables;

class TypeRoomController extends Controller
{
    protected $typeRoomService;
    protected $imageService;
    protected $deviceService;

    public function __construct(
        TypeRoomService $typeRoomService,
        ImageService $imageService,
        DeviceService $deviceService
    )
    {
        $this->typeRoomService = $typeRoomService;
        $this->imageService = $imageService;
        $this->deviceService = $deviceService;
    }

    public function index()
    {
        return view('admin.typeroom.index');
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

    public function createTypeRoom()
    {
        $images = $this->imageService->getImages();
        $devices = $this->deviceService->getDevices();

        return view('admin.typeroom.form', compact('images', 'devices'));
    }

    public function actionCreateTypeRoom(TypeRoomRequest $request)
    {
        $this->typeRoomService->createOrUpdate($request);
        $typeRoom = $this->typeRoomService->getItemLast();
        $this->deviceService->saveDeviceTypeRoom($typeRoom->id, $request->devices);
        $this->imageService->saveImageTypeRoom( $typeRoom->id, $request->images);

        return redirect()->route('admin.type-rooms.index')->with('message', 'Create TypeRoom Successfully !');
    }

    public function delete($id)
    {
        if ($this->typeRoomService->find($id)->rooms->isEmpty())
        {
            $this->typeRoomService->delete($id);
            return redirect()->route('admin.type-rooms.index')->with('message', 'Delete TypeRoom Successfully !');
        }

        return redirect()->route('admin.type-rooms.index')->with('error', "You Can't Delete TypeRoom !");
    }

    public function detail($id)
    {
        $typeRoom = $this->typeRoomService->find($id);

        return view('admin.typeroom.detail', compact('typeRoom'));
    }

    public function edit($id)
    {
        $typeRoom = $this->typeRoomService->find($id);
        $images = $this->imageService->getImages();
        $typeRoom->images;
        $devices = $this->deviceService->getDevices();
        $deviceTypeRoom = $this->deviceService->getDeviceTypeRoom($id)->toArray();

        return view('admin.typeroom.form', compact('typeRoom', 'images', 'devices', 'deviceTypeRoom'));
    }

    public function actionEdit($id, TypeRoomRequest $request)
    {
        $this->typeRoomService->createOrUpdate($request, $id);
        $this->imageService->saveImageTypeRoom( $id, $request->images);
        $this->deviceService->saveDeviceTypeRoom($id, $request->devices);

        return redirect()->route('admin.type-rooms.index')->with('message', 'Update TypeRoom Successfully !');
    }
}
