<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use App\Service\DeviceService;
use App\Http\Controllers\Controller;
use App\Service\ImageService;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use PDF;

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

    public function edit(Device $device)
    {
        $device = $this->deviceService->find($device->id);

        return view('admin.device.form', compact('device'));
    }

    public function actionEdit(DeviceRequest $request, Device $device)
    {
        $this->deviceService->createOrUpdate($request, $device->id);

        return redirect()->route('admin.devices.index')->with('message', 'Update Device Successfully !');
    }

    public function delete(Device $device)
    {
        if ($this->deviceService->find($device->id)->typeRooms->isEmpty()) {
            $this->deviceService->delete($device->id);

            return redirect()->route('admin.devices.index')->with('message', 'Delete Device Successfully !');
        }

        return redirect()->route('admin.devices.index')->with('error', 'You Can\'t Delete Device !');
    }

    public function detail(Device $device)
    {
        return view('admin.device.detail', compact('device'));
    }

    public function exportPDF()
    {
        $devices = $this->deviceService->getDevices();

        $pdf = PDF::loadView('admin.export-pdf.devices', compact('devices'));
        //$pdf->save(storage_path().'devices.pdf');
        return $pdf->download('devices'.Carbon::now().'.pdf');
    }

    public function importExcel()
    {

    }
}
