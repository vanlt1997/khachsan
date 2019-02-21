<?php

namespace App\Http\Controllers\Admin;

use App\Service\DeviceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class DeviceController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index()
    {
        return view('admin.device.index');
    }

    public function getList()
    {
        return DataTables::of($this->deviceService->getDevices())->make();
    }
}
