<?php

namespace App\Http\Controllers\Admin;

use App\Service\ServiceService;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return view('admin.service.index');
    }

    public function getList()
    {
        return DataTables::of($this->serviceService->getServices())
            ->addColumn('action', function ($service) {
                return
                    '<a href="services/' . $service->id . '/detail" class="btn btn-sm btn-outline-warning"> <i class="fa fa-info"></i></a>
                    <a href="services/' . $service->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="services/' . $service->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make();
    }
}