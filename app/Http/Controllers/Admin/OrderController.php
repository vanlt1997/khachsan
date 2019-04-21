<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Card;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderTypeRoom;
use App\Models\Room;
use App\Models\User;
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
    const WAIT = 1;

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

    public function orderWait()
    {
        return view('admin.order.wait');
    }

    public function orderHandles()
    {
        return view('admin.order.handled');
    }

    public function getList()
    {
        return DataTables::of($this->orderService->orders())
            ->addColumn('user_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('status_name', function ($order) {
                return $order->statusOrder->name;
            })
            ->addColumn('action', function ($order) {
                $html = null;
                if ($order->status_order_id === self::WAIT) {
                    $html = '<a href="orders/wait/' . $order->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>';
                } else {
                    $html = '<a href="orders/handled/' . $order->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>';
                }
                return
                    $html.'<a href="orders/' . $order->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
    }

    public function getOrderWait()
    {
        return DataTables::of($this->orderService->getOrderWait())
            ->addColumn('user_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('action', function ($order) {
                return
                    '<a href="wait/' . $order->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="' . $order->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make(true);
    }

    public function getOrderHandled()
    {
        return DataTables::of($this->orderService->getOrderHanded())
            ->addColumn('user_name', function ($order) {
                return $order->user->name;
            })
            ->addColumn('action', function ($order) {
                return
                    '<a href="handled/' . $order->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="' . $order->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make(true);
    }

    public function create()
    {
        $users = $this->userService->users();
        $status = $this->statusOrderService->statusOrders();
        $payments = $this->paymentService->payments();
        $infoTypeRooms = $this->orderService->getNumberRoomsMoreDateNow();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('admin.order.form', compact('users', 'status', 'payments', 'infoTypeRooms', 'typeRooms'));
    }

    public function searchRoom(Request $request)
    {
        $rooms = $this->orderService->getRoomsWhenSearchInAdmin($request);
        $typeRoom = $this->orderService->actionQuery($request);
        if ($typeRoom->isEmpty() || $typeRoom[0]->total_room*$typeRoom[0]->number_people < $request->number_people) {
            return response()->json(0, 200);
        } else {
            return response()->json($rooms, 200);
        }
    }

    public function selectUser(Request $request)
    {
        $user = $this->userService->find($request->userID);

        return response()->json($user, 200);
    }

    public function calculate(Request $request)
    {
        $typeRoomId = $request->typeRoom;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $number_people = $request->number_people;

        if (!$startDate && !$endDate && !$number_people) {
            return response()->json(null, 200);
        }
        $nameRooms = $request->nameRooms;
        $arrRoom = [];
        $arrNameRooms = explode(',', $nameRooms);
        foreach ($arrNameRooms as $nameRoom) {
            $room = $this->roomService->getRoomByName($nameRoom);
            if ((int)$room->type_room_id === (int)$typeRoomId) {
                $arrRoom[] = $room;
            }
        }
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $typeRoom = $this->typeRoomService->find($typeRoomId);
        $card->addTypeRoom($typeRoomId, $typeRoom, $startDate, $endDate, $number_people, 0, $arrRoom);
        Session::put('card', $card);

        $card = Session::get('card');
        foreach ($card->typeRooms as $typeRoom) {
            $nameTypeRooms[] = $typeRoom['typeRoom']->name;
        }
        $data = ['total' => $card->total, 'nameTypeRooms' => $nameTypeRooms ];

        return response()->json($data, 200);
    }

    public function actionCreate(OrderRequest $request)
    {
        $card = Session::get('card');
        $typeRooms = $this->typeRoomService->getTypeRooms();
        $promotion = $this->promotionService->checkCode(trim($request->promotion));
        if ($promotion) {
            $card->promotion = $promotion->sale;
            $card->paymentTotal = $card->total - $promotion->sale;
        }
        Session::put('card', $card);
        $card = Session::get('card');
        //dd($card->typeRooms[1]['rooms']);
        $infoBooling = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'address' => $request->address,
            'payment' => $request->payment_method
        ];
        Session::put('infoBooking', $infoBooling);

        return view('admin.order.confirm', compact('request', 'card', 'typeRooms'));
    }

    public function deleteTypeRoomWhenBooking(Request $request)
    {
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $card->deleteTypeRoom($request->id);
        $data = null;
        if (count($card->typeRooms) > 0) {
            Session::put('card', $card);
            $data = ['total' => $card->total, 'promotion' => $card->promotion, 'paymentTotal' => $card->paymentTotal];
        } else {
            Session::forget('card');
        }
        return response()->json($data, 200);
    }

    public function finishCreate()
    {
        $card = Session::get('card');
        $customer = Session::get('infoBooking');
        $newUser = $this->userService->getUserByEmai($customer['email']);
        if (!$newUser) {
            $this->userService->createOrUpdate($customer);
        }
        $newUser = $this->userService->getUserByEmai($customer['email']);
        $order = new Order();
        $order->user_id = $newUser->id;
        $order->status_order_id =self::HANDLED;
        $order->payment_method = $customer['payment'];
        $order->quantity = $card->sumRoom;
        $order->promotion = $card->promotion;
        $order->total = $card->total;
        $order->payment_total = $card->paymentTotal;
        $order->date = Carbon::now()->format('Y-m-d');
        DB::transaction(function () use ($order, $card, $customer) {
            $this->orderService->createOrUpdate($order);
            $orderID = Order::max('id');
            foreach ($card->typeRooms as $typeRoom) {
                $this->orderService->createOrUpdateOrderTypeRoom($orderID, $typeRoom, count($typeRoom['typeRoom']->rooms) ?? 0);
                if ($typeRoom['typeRoom']->rooms) {
                    foreach ($typeRoom['typeRoom']->rooms as $room) {
                        $orderTypeRoomId = OrderTypeRoom::max('id');
                        $orderDetail = new OrderTypeRoom();
                        $orderDetail->order_type_room_id = $orderTypeRoomId;
                        $orderDetail->room_id = $room->id;
                        $orderDetail->date = Carbon::now()->format('Y-m-d');
                        $orderDetail->start_date = $typeRoom['startDate'];
                        $orderDetail->end_date = $typeRoom['endDate'];
                        $this->orderService->createOrUpdateOrderDetail($orderDetail);
                    }
                }
            }
        });

        Session::forget('card');
        Session::forget('infoBooking');

        return redirect()->route('admin.orders.handled')->with('message', 'Create Order Successfully !');
    }

    public function editHandled(Order $order)
    {
        $status = $this->statusOrderService->statusOrders();
        $payments = $this->paymentService->payments();
        $infoTypeRooms = $this->orderService->getNumberRoomsMoreDateNow();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('admin.order.form-edit', compact('order', 'status', 'payments', 'typeRooms', 'infoTypeRooms'));
    }

    public function confirm(Order $order, Request $request)
    {
        $total = 0;
        $info = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'address' => $request->address,
            'payment' => $order->payment_method,
        ];

        foreach ($order->orderTypeRooms as $orderTypeRoom) {
            $typeRoom = $orderTypeRoom->typeRoom;
            $startDate =Carbon::parse($request['startDate'.$orderTypeRoom->type_room_id]);
            $endDate =Carbon::parse($request['endDate'.$orderTypeRoom->type_room_id]);
            $sum_day=(int)($endDate->diffInDays($startDate));
            if ($typeRoom->sale > 0) {
                $totalType = $typeRoom->price * $sum_day * $request['number_people'.$orderTypeRoom->type_room_id]
                    * (100 - $typeRoom->sale) /100;
            } else {
                $totalType = $typeRoom->price * $sum_day * $request['number_people'.$orderTypeRoom->type_room_id];
            }

            $total += $totalType;

            $nameRooms = $request['nameRoom'];
            $arrNameRooms = explode(',', $nameRooms);
            foreach ($arrNameRooms as $nameRoom) {
                $room = $this->roomService->getRoomByName($nameRoom);
                if ($room->typeRoom->id === $orderTypeRoom->type_room_id) {
                    $rooms[] = $room;
                }
            }
            $infoTypeRoom = [
                'id' => $orderTypeRoom->id,
                'typeRoom' => $typeRoom,
                'rooms' => $rooms,
                'start_date' => $request['startDate'.$orderTypeRoom->type_room_id],
                'end_date' => $request['endDate'.$orderTypeRoom->type_room_id],
                'number_people' => $request['number_people'.$orderTypeRoom->type_room_id],
                'total' => $totalType
            ];
            $rooms = [];
            $orders[] = $infoTypeRoom;
        }
        Session::put('order', [
            'orderOld' => $order,
            'info' => $info,
            'orders' => $orders,
            'total' => $total,
            'promotion' => $request->promotion,
            'paymentTotal' => $total - $request->promotion,
            'paymentNew' => $total - $request->promotion - $order->payment_total
        ]);

        $order = Session::get('order');
        //dd($order['id']);
        return view('admin.order.edit-handled', compact('order'));
    }

    public function finishEditHandled()
    {
        $order = Session::get('order');
        DB::transaction(function () use ($order) {
            $user = $this->userService->getUserByEmai($order['info']['email']);
            if (!$user) {
                $this->userService->createOrUpdate($order['info']);
            }
            $user = $this->userService->getUserByEmai($order['info']['email']);
            $orderNew = $this->orderService->find($order['orderOld']->id);
            $orderNew->user_id = $user->id;
            $orderNew->quantity = count($order['orders']);
            $orderNew->promotion = $order['promotion'];
            $orderNew->total = $order['total'];
            $orderNew->payment_total = $order['paymentTotal'];
            $orderNew->date = Carbon::now()->format('Y-m-d');
            $orderNew->save();
            // Update order type room
            foreach ($order['orders'] as $item) {
                $orderTypeRoom = $this->orderService->findOrderTypeRoom($item['id']);
                $orderTypeRoom->number_people = $item['number_people'];
                $orderTypeRoom->number_room = count($item['rooms']);
                $orderTypeRoom->price = $item['typeRoom']->price;
                $orderTypeRoom->sale = $item['typeRoom']->sale;
                $orderTypeRoom->total = $item['total'];
                $orderTypeRoom->start_date = $item['start_date'];
                $orderTypeRoom->end_date = $item['end_date'];

                $orderTypeRoom->save();
                $this->orderService->deleteOrderDetailByOrderTypeRoom($item['id']);

                foreach ($item['rooms'] as $room) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_type_room_id = $item['id'];
                    $orderDetail->room_id = $room->id;
                    $orderDetail->date = Carbon::now()->format('Y-m-d');
                    $orderDetail->start_date = $item['start_date'];
                    $orderDetail->end_date = $item['end_date'];

                    $orderDetail->save();

                }
            }
        });

        return redirect()->route('admin.orders.handled')
            ->with('message', 'Update '.$order['orderOld']->id.' Successfully !');
    }

    public function deleteOrder(Order $order)
    {
        if ($this->orderService->deleteOrder($order)) {
            return redirect()->back()->with('message', 'Delete order successfully !');
        }

        return redirect()->back()->with('error', 'Don\'t order delete !');
    }

    public function editWait(Order $order)
    {
        $status = $this->statusOrderService->statusOrders();
        $payments = $this->paymentService->payments();
        $infoTypeRooms = $this->orderService->getNumberRoomsMoreDateNow();
        $typeRooms = $this->typeRoomService->getTypeRooms();
        //dd($order->orderTypeRooms[0]->typeRoom->name);

        return view('admin.order.wait.form', compact('order', 'status', 'payments', 'typeRooms', 'infoTypeRooms'));
    }

    public function actionEditWait(Order $order, Request $request)
    {
        DB::transaction(function () use ($order, $request) {
            foreach ($order->orderTypeRooms as $orderTypeRoom) {
                $nameRooms = $request['nameRoom'];
                $arrNameRooms = explode(',', $nameRooms);
                foreach ($arrNameRooms as $nameRoom) {
                    $room = $this->roomService->getRoomByName($nameRoom);
                    if ($room->typeRoom->id === $orderTypeRoom->type_room_id) {
                        $orderDetail = new OrderTypeRoom();
                        $orderDetail->order_type_room_id = $orderTypeRoom->id;
                        $orderDetail->room_id = $room->id;
                        $orderDetail->date = Carbon::now()->format('Y-m-d');
                        $orderDetail->start_date = $orderTypeRoom->start_date;
                        $orderDetail->end_date = $orderTypeRoom->end_date;
                        $this->orderService->createOrUpdateOrderDetail($orderDetail);
                    }
                }
            }
            $order->status_order_id = self::HANDLED;
            $this->orderService->createOrUpdate($order, $order->id);
        });


        return redirect()->route('admin.orders.wait')->with('message', 'Order '.$order->id.' Handled Successfully !');
    }

    public function delete()
    {
        Session::forget('card');

        return response()->json(null, 204);
    }

}
