<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\SearchRoomRequest;
use App\Service\ContactService;
use App\Service\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Service;
use App\Models\TypeRoom;
use App\Service\ImageService;
use App\Service\PromotionService;
use App\Service\ServiceService;
use App\Service\SlideBarService;
use App\Service\TypeRoomService;

class IndexController extends Controller
{
    protected $slideBarService;
    protected $serviceService;
    protected $typeRoomService;
    protected $imageService;
    protected $promotionService;
    protected $contactService;
    protected $orderService;

    public function __construct(
        SlideBarService $slideBarService,
        ServiceService $serviceService,
        TypeRoomService $typeRoomService,
        ImageService $imageService,
        PromotionService $promotionService,
        ContactService $contactService,
        OrderService $orderService
    ) {
        $this->slideBarService = $slideBarService;
        $this->serviceService = $serviceService;
        $this->typeRoomService = $typeRoomService;
        $this->imageService = $imageService;
        $this->promotionService = $promotionService;
        $this->contactService = $contactService;
        $this->orderService = $orderService;
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

        return view('client.typeroom.detail', compact('typeRoom', 'slidebars', 'images'));
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
        $this->contactService->sendMail($request);

        return redirect()->back()->with('message', 'Thank you for contact with us !');
    }

    public function promotion()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $promotions = $this->promotionService->getPromotions();

        return view('client.promotion', compact('slidebars', 'images', 'promotions'));
    }

    public function searchRoom(SearchRoomRequest $request)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $typeRooms = $this->orderService->actionQuery($request, 'client');
        $totalPeople = 0;
        foreach ($typeRooms as $typeRoom) {
            $totalPeople += (int)$typeRoom->total_room*(int)$typeRoom->number_people;
        }

        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !');
        }

        return view('client.typeroom.search-type-room', compact('slidebars', 'images', 'typeRooms'));
    }

    public function searchRoomOfDetailTypeRoom(TypeRoom $typeRoom, SearchRoomRequest $request)
    {
        $typeRooms = $this->orderService->actionQuery($request, 'client');
        $totalPeople = 0;
        foreach ($typeRooms as $typeRoom) {
            $totalPeople += (int)$typeRoom->total_room*(int)$typeRoom->number_people;
        }

        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !');
        }

        return redirect()->route('client.typerooms.detail', $typeRoom->id)->with('message', "Have $typeRoom->total_room rooms you can choose !")->withInput();
    }
}
