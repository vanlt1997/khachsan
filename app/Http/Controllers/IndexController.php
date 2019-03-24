<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\SendMailRequest;
use App\Models\Service;
use App\Models\TypeRoom;
use App\Service\ImageService;
use App\Service\PromotionService;
use App\Service\ServiceService;
use App\Service\SlideBarService;
use App\Service\TypeRoomService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $slideBarService;
    protected $serviceService;
    protected $typeRoomService;
    protected $imageService;
    protected $promotionService;

    public function __construct
    (
        SlideBarService $slideBarService,
        ServiceService $serviceService,
        TypeRoomService $typeRoomService,
        ImageService $imageService,
        PromotionService $promotionService
    )
    {
        $this->slideBarService = $slideBarService;
        $this->serviceService = $serviceService;
        $this->typeRoomService = $typeRoomService;
        $this->imageService = $imageService;
        $this->promotionService = $promotionService;
        session_start();
    }

    public function index()
    {
        $services = $this->serviceService->getServices();
        $slidebars = $this->slideBarService->getSlideBars();
        $typeRooms = $this->typeRoomService->getTypeRooms();
        $images = $this->imageService->getImagesFooter();

        return view('client.index', compact('services', 'slidebars', 'typeRooms', 'images'));
    }

    public function typeRoom()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('client.typeroom.index', compact('slidebars', 'images', 'typeRooms'));
    }

    public function detailTypeRoom(TypeRoom $typeRoom)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.typeroom.detail', compact('typeRoom','slidebars', 'images'));

    }

    public function services()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $services = $this->serviceService->getServices();
        $images = $this->imageService->getImagesFooter();

        return view('client.service.index', compact('slidebars', 'services', 'images'));
    }

    public function detailService(Service $service)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.service.detail', compact('service', 'slidebars', 'images'));
    }

    public function introduction()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.introduction', compact('slidebars', 'images'));
    }

    public function contact()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.contact', compact('slidebars', 'images'));
    }

    public function sendMail(ContactRequest $request)
    {

    }

    public function promotion()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $promotions = $this->promotionService->getPromotions();

        return view('client.promotion', compact('slidebars','images', 'promotions'));
    }
}
