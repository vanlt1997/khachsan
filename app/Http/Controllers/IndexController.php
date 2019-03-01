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

        return view('client.index', compact('services', 'slidebars'));
    }

    public function dichVu()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $services = $this->serviceService->getServices();
        return view('client.dichvu.index',compact('slidebars','services'));
    }

    public function chiTietDichVu($name){

    }

    public function gioiThieu()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        return view('client.gioithieu',compact('slidebars'));
    }

    public function lienHe()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        return view('client.lienhe',compact('slidebars'));
    }

    public function guiMail(Request $request)
    {

    }
    public function uuDai()
    {

    }

    public function loaiPhong()
    {

    }

    public function chiTietLoaiPhong($name){

    }

}
