<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Service\ServiceService;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->getServices();
        return view('admin.service.index', compact('services'));
    }

    public function delete(Request $request)
    {
        $this->serviceService->delete($request->id);
        return $request->id;
    }

    public function action(Request $request)
    {
        if ($request->id > 0)
        {
            $this->serviceService->update($request);
            $service = Service::find((int)$request->id);
            return response()->json($service, 204);
        }
        else{
            $this->serviceService->create($request);
            $service = $this->serviceService->getFirst();
            return response()->json($service, 201);
        }

    }
}
