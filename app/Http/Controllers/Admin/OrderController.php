<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Room;
use App\Service\OrderService;
use App\Http\Controllers\Controller;
use App\Service\PaymentService;
use App\Service\RoomService;
use App\Service\StatusOrderService;
use App\Service\TypeRoomService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    protected $orderService;
    protected $userService;
    protected $paymentService;
    protected $statusOrderService;
    protected $typeRoomService;
    protected $roomService;

    public function __construct(
        OrderService $orderService,
        UserService $userService,
        PaymentService $paymentService,
        StatusOrderService $statusOrderService,
        TypeRoomService $typeRoomService,
        RoomService $roomService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->statusOrderService = $statusOrderService;
        $this->typeRoomService = $typeRoomService;
        $this->roomService = $roomService;
    }

    public function index()
    {
        return view('admin.order.index');
    }

    public function getList()
    {
        return DataTables::of($this->orderService->orders())
            ->addColumn('user_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('statu_name', function ($order) {
                return $order->statusOrder->name;
            })
            ->addColumn('action', function ($order) {
                return
                    '<a href="orders/' . $order->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="orders/' . $order->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
    
                    ';
            })
            ->make(true);
    }

    public function create()
    {
        $users = $this->userService->users();
        $status = $this->statusOrderService->statusOrders();
        $payments = $this->paymentService->payments();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('admin.order.form', compact('users', 'status', 'payments', 'typeRooms'));
    }

    public function searchRoom(Request $request)
    {
        $rooms = $this->orderService->checkRoom($request);
        if ($rooms['total_people'] < $request->number_people) {
            return response()->json(0, 200);
        } else {
            return response()->json($rooms['rooms'], 200);
        }
    }

    public function selectUser(Request $request)
    {
        $user = $this->userService->find($request->userID);

        return response()->json($user, 200);
    }

    public function calculate(Request $request)
    {
        dd($request);

    }

    public function edit(Order $order)
    {

    }

    public function actionEdit(Order $order)
    {

    }

    public function delete(Order $order)
    {
        if ($this->orderService->deleteOrder($order)) {
            return redirect()->back()->with('message', 'Delete order successfully !');
        }

        return redirect()->back()->with('error', 'Don\'t order delete !');
    }

}
