<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\CalendarService;
use App\Service\ContactService;
use App\Service\ImageService;
use App\Service\OrderService;
use App\Service\PromotionService;
use App\Service\RevenueService;
use App\Service\RoomService;
use App\Service\TypeRoomService;
use App\Service\UserService;
use Carbon\Carbon;

class IndexController extends Controller
{
    protected $orderService;
    protected $userService;
    protected $roomService;
    protected $revenueService;
    protected $calendarService;
    protected $typeRoomService;
    protected $promotionService;
    protected $imageService;
    protected $contactService;

    public function __construct(
        OrderService $orderService,
        UserService $userService,
        RoomService $roomService,
        RevenueService $revenueService,
        CalendarService $calendarService,
        TypeRoomService $typeRoomService,
        PromotionService $promotionService,
        ImageService $imageService,
        ContactService $contactService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->roomService = $roomService;
        $this->revenueService = $revenueService;
        $this->calendarService = $calendarService;
        $this->typeRoomService = $typeRoomService;
        $this->promotionService = $promotionService;
        $this->imageService = $imageService;
        $this->contactService = $contactService;
    }

    public function index()
    {
        $orders = $this->orderService->orders();
        $users = $this->userService->users();
        $rooms = $this->roomService->rooms();
        $typeRooms = $this->typeRoomService->getTypeRooms();
        $promotions = $this->promotionService->promotions();
        $contacts = $this->contactService->contacts();
        $images = $this->imageService->getImages();

        $dataYears = $this->revenueService->reportYear();
        $chartYear [] = ['Year', 'Revenue'];
        foreach ($dataYears as $year) {
            $chartYear[] = [ "$year->year", $year->total];
        }

        $calendarRooms = $this->calendarService->rooms();
        $data = [];
        foreach ($calendarRooms as $room) {
            $data[] = [
                $room->room->typeRoom->name,
                'Room '.$room->room->name,
                Carbon::parse($room->start_date),
                Carbon::parse($room->end_date)
            ];
        }

        return view('admin.index', compact('orders', 'users', 'rooms', 'chartYear', 'data', 'typeRooms', 'promotions', 'contacts', 'images'));
    }
}
