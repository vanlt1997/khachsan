<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Card;
use App\Models\Order;
use App\Models\OrderTypeRoom;
use App\Models\Room;
use App\Service\OrderService;
use App\Http\Controllers\Controller;
use App\Service\PaymentService;
use App\Service\PromotionService;
use App\Service\RoomService;
use App\Service\StatusOrderService;
use App\Service\TypeRoomService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    const HANDLED = 2;

    protected $orderService;
    protected $userService;
    protected $paymentService;
    protected $statusOrderService;
    protected $typeRoomService;
    protected $roomService;
    protected $promotionService;

    public function __construct(
        OrderService $orderService,
        UserService $userService,
        PaymentService $paymentService,
        StatusOrderService $statusOrderService,
        TypeRoomService $typeRoomService,
        RoomService $roomService,
        PromotionService $promotionService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->statusOrderService = $statusOrderService;
        $this->typeRoomService = $typeRoomService;
        $this->roomService = $roomService;
        $this->promotionService = $promotionService;
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

    public function actionCreate(OrderRequest $request)
    {
        $card = Session::get('card');
        $rooms = Session::get('rooms');
        $user = $this->userService->getUserByEmai($request->email);
        if (! $user) {
            $this->userService->createOrUpdate($request);
        }
        //dd($card);
        $order = new Order();
        $order->user_id = $user->id;
        $order->status_order_id = $request->status;
        $order->payment_method = $request->payment_method;
        $order->quantity = $card->sumRoom;
        $order->promotion = $card->promotion;
        $order->total = $card->total;
        $order->payment_total = $card->paymentTotal;
        $order->date = Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($order, $card, $rooms, $request) {
            $this->orderService->createOrUpdate($order);
            $orderID = Order::max('id');
            foreach ($card->typeRooms as $typeRoom) {
                $this->orderService->createOrderTypeRoom($orderID, $typeRoom, 0);
                $orderTypeRoomId = OrderTypeRoom::max('id');
                $number_room = 0;
                foreach ($rooms as $room) {
                    if ($typeRoom['typeRoom']->id === $room->typeRoom->id) {
                        $number_room++;
                        $orderDetail = new OrderTypeRoom();
                        $orderDetail->order_type_room_id = $orderTypeRoomId;
                        $orderDetail->room_id = $room->id;
                        $orderDetail->date = Carbon::now()->format('Y-m-d');
                        $orderDetail->start_date = $request->startDate;
                        $orderDetail->end_date = $request->endDate;
                        $this->orderService->createOrUpdateOrderDetail($orderDetail);
                    }
                }
                $this->orderService->createOrderTypeRoom($orderID, $typeRoom, $number_room, $orderTypeRoomId);
            }
        });

        return redirect()->route('admin.orders.index')->with('message', 'Create Order Successfully !')->withInput();
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
        Session::forget('order');
        Session::forget('rooms');
        $typeRoomId = $request->typeRoom;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $number_people = $request->number_people;
        $nameRooms = $request->nameRooms;
        $code = $request->promotion;
        $promotion = $this->promotionService->checkCode($code);
        $pricePromotion = $promotion? $promotion->sale : 0;
        $arrRoom = [];
        $arrNameRooms = explode(',', $nameRooms);
        foreach ($arrNameRooms as $nameRoom) {
            $arrRoom[] = $this->roomService->getRoomByName($nameRoom);
        }

        if ($typeRoomId) {
            $oldCard = Session::has('card') ? Session::get('card') : null;
            $order = new Card($oldCard);
            $typeRoom = $this->typeRoomService->find($typeRoomId);
            $order->addTypeRoom($typeRoomId, $typeRoom, $startDate, $endDate, $number_people, $pricePromotion);
            Session::put('card', $order);
        } else {
            $typeRooms = [];
            foreach ($arrRoom as $room) {
                if (! array_key_exists($room->typeRoom->id, $typeRooms)) {
                    $typeRooms[$room->typeRoom->id] = $room->typeRoom;
                }
            }
            $oldCard = Session::has('card') ? Session::get('card') : null;
            $order = new Card($oldCard);
            foreach ($typeRooms as $typeRoom) {
                $order->addTypeRoom($typeRoom->id, $typeRoom, $startDate, $endDate, $number_people, $pricePromotion);
                Session::put('card', $order);
            }
        }
        if ($arrRoom) {
            Session::put('rooms', $arrRoom);
        }

        $card = Session::get('card');
        $data = ['total' => $card->total, 'promotion' => $card->promotion, 'payment' => $card->paymentTotal];

        return response()->json($data, 200);
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
