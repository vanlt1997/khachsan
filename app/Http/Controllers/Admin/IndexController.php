<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;

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

    public function info()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    public function editInfo()
    {
        $user = Auth::user();

        return view('admin.profile.update-information', compact('user'));
    }

    public function actionEditInfo(UserRequest $request)
    {
        $this->userService->createOrUpdate($request, Auth::id());

        return redirect()->route('admin.info')->with('message', 'Update information successfully !');
    }

    public function editPassword()
    {
        $user = Auth::user();

        return view('admin.profile.update-password', compact('user'));
    }

    public function actionEditPassword(InformationRequest $request)
    {
        $user = Auth::user();
        if ($user && password_verify($request->password_old, $user->password)) {
            if ($request->password === $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('admin.info')->with('error', 'Update password error !');
        }
        return redirect()->route('admin.info')->with('message', 'Update password successfully !');
    }
}
