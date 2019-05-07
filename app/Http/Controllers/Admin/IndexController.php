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
use Illuminate\Support\Facades\Auth;

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
        return view('admin.index');
    }

    public function getData()
    {
        $orders = $this->orderService->orders();
        $orderWait = $this->orderService->getOrderWait();
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
        return response()->json([
            'orders' => count($orders),
            'users' => count($users),
            'rooms' => count($rooms),
            'typeRooms' => count($typeRooms),
            'contacts' => count($contacts),
            'images' => count($images),
            'promotions' => count($promotions),
            'data' => $data,
            'chartYear' => json_encode($chartYear),
            'dataWait' => $orderWait
        ]);
    }

    public function notificationBooking()
    {
        return Auth::user()->unreadNotifications;
    }
}
