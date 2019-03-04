<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SlideBar;
use App\Service\ServiceService;
use App\Service\SlideBarService;
use App\Service\TypeRoomService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $slideBarService;
    protected $serviceService;
    protected $typeRoomService;

    public function __construct
    (
        SlideBarService $slideBarService,
        ServiceService $serviceService,
        TypeRoomService $typeRoomService
    )
    {
        $this->slideBarService = $slideBarService;
        $this->serviceService = $serviceService;
        $this->typeRoomService = $typeRoomService;
        session_start();
    }

    public function index() {
        $services = $this->serviceService->getServices();
        $slidebars = $this->slideBarService->getSlideBars();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('client.index', compact('services', 'slidebars', 'typeRooms'));
    }

    public function services()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $services = $this->serviceService->getServices();
        return view('client.service.index',compact('slidebars','services'));
    }

    public function detailService($name){

    }

    public function introduction()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        return view('client.introduction',compact('slidebars'));
    }

    public function contact()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        return view('client.contact',compact('slidebars'));
    }

    public function sendMail(Request $request)
    {

    }
    public function promotion()
    {

    }

    public function typeRoom()
    {

    }

    public function detailTypeRoom($name){

    }

}
