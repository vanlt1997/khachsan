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
    public function __construct(SlideBarService $slideBarService, ServiceService $serviceService)
    {
        $this->slideBarService = $slideBarService;
        $this->serviceService = $serviceService;
    }

    public function trangchu() {
        return view('client.index');
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
