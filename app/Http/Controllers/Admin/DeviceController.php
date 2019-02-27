<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeviceRequest;
use App\Service\DeviceService;
use App\Http\Controllers\Controller;
use App\Service\ImageService;
use Yajra\DataTables\DataTables;

class DeviceController extends Controller
{
    protected $deviceService;
    protected $imageService;

    public function __construct(DeviceService $deviceService, ImageService $imageService)
    {
        $this->deviceService = $deviceService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        return view('admin.device.index');
    }

    public function getList()
    {
        return DataTables::of($this->deviceService->getDevices())
            ->addColumn('action', function ($device) {
                return
                    '<a href="devices/' . $device->id . '/detail" class="btn btn-sm btn-outline-warning"> <i class="fa fa-info"></i></a>
                    <a href="devices/' . $device->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="devices/' . $device->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make();
    }

    public function create()
    {
        $images = $this->imageService->getImages();

        return view('admin.device.form', compact('images'));
    }

    public function actionCreate(DeviceRequest $request)
    {
        $this->deviceService->createOrUpdate($request);

        return redirect()->route('admin.devices.index')->with('message', 'Create Device Successfully !');
    }

    public function edit($id)
    {
        $device = $this->deviceService->find($id);

        return view('admin.device.form', compact('device'));
    }

    public function actionEdit(DeviceRequest $request, $id)
    {
        $this->deviceService->createOrUpdate($request, $id);

        return redirect()->route('admin.devices.index')->with('message', 'Update Device Successfully !');
    }

    public function delete($id)
    {
        if ($this->deviceService->find($id)->typeRooms->isEmpty()) {
            $this->deviceService->delete($id);

            return redirect()->route('admin.devices.index')->with('message', 'Delete Device Successfully !');
        }

        return redirect()->route('admin.devices.index')->with('error', 'You Can\'t Delete Device !');
    }

    public function detail($id)
    {
        $device = $this->deviceService->find($id);

        return view('admin.device.detail', compact('device'));
    }
}
