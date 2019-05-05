<?php
/**
 * Created by PhpStorm.
 * User: levan
 * Date: 30/03/2019
 * Time: 11:26
 */

namespace App\Service;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderTypeRoom;
use App\Models\Room;
use App\Models\TypeRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    const STATUS_ROOM = [3, 4];
    const WAIT = 1;
    const HANDLED = 2;

    protected $order;
    protected $typeRoom;
    protected $room;
    protected $orderTypeRoom;
    protected $orderDetail;

    public function __construct(
        Order $order,
        TypeRoom $typeRoom,
        Room $room,
        OrderTypeRoom
        $orderTypeRoom,
        OrderDetail $orderDetail
    ) {
        $this->order = $order;
        $this->typeRoom = $typeRoom;
        $this->room = $room;
        $this->orderTypeRoom = $orderTypeRoom;
        $this->orderDetail = $orderDetail;
    }

    public function orders()
    {
        return $this->order->with(['payment', 'user', 'promotions', 'typeRooms', 'statusOrder'])
            ->orderBy('status_order_id', 'asc')
            ->get();
    }

    public function getOrderWait()
    {
        return $this->order->with(['payment', 'user', 'promotions', 'typeRooms', 'statusOrder'])
            ->where('status_order_id', self::WAIT)
            ->get();
    }

    public function getOrderHanded()
    {
        return $this->order->with(['payment', 'user', 'promotions', 'typeRooms', 'statusOrder'])
            ->where('status_order_id', self::HANDLED)
            ->get();
    }


    public function actionQuery($data)
    {
        $query = DB::table('type_rooms')->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
                                        ->where('rooms.status_id', '!=', 4);
        if ($data->typeRoom !== null) {
            $query->where('type_rooms.id', $data->typeRoom);
        }
        $query->whereIn('rooms.id', function ($query) use ($data) {
            $query->select('rooms.id')
                ->from('type_rooms')
                ->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
                ->leftjoin('order_detail', 'rooms.id', '=', 'order_detail.room_id')
                ->whereNull('order_detail.start_date')
                ->orWhere('order_detail.start_date', '>=', $data->endDate)
                ->orWhere('order_detail.end_date', '<=', $data->startDate);
        })->select(
            DB::raw('count(*) as total_room'),
            'type_rooms.id as id',
            'type_rooms.name as type_room_name',
            'price',
            'type_rooms.people as number_people',
            'bed',
            'extra_bed',
            'acreage',
            'view',
            'type_rooms.description as description',
            'sale'
        )->groupBy('type_rooms.id');
        return $query->get();
    }

    public function getNumberRoomsMoreDateNow()
    {
        $query = DB::table('type_rooms')->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
            ->where('rooms.status_id', '!=', 4)
            ->orWhereIn('rooms.type_room_id', function ($query) {
                $query->select('rooms.type_room_id')
                    ->from('rooms')
                    ->leftjoin('order_detail', 'rooms.id', '=', 'order_detail.room_id')
                    ->whereNull('order_detail.start_date')
                    ->orWhere('order_detail.start_date', '>=', Carbon::now()->format('Y-m-d'));
            })->select(
                DB::raw('count(*) as total_room'),
                'type_rooms.id as id',
                'type_rooms.name as type_room_name',
                'price',
                'type_rooms.people as number_people',
                'bed',
                'extra_bed',
                'acreage',
                'view',
                'type_rooms.description as description',
                'sale'
            )->groupBy('type_rooms.id');

        return $query->get();
    }

    public function getRoomsWhenSearchInAdmin($data)
    {
        $query = DB::table('rooms')
            ->where('rooms.type_room_id', $data->typeRoom)
            ->where('rooms.status_id', '!=', 4)
            ->whereIn('rooms.id', function ($query) use ($data) {
                $query->select('rooms.id')
                    ->from('rooms')
                    ->leftjoin('order_detail', 'rooms.id', '=', 'order_detail.room_id')
                    ->whereNull('order_detail.start_date')
                    ->orWhere('order_detail.start_date', '>=', $data->endDate)
                    ->orWhere('order_detail.end_date', '<=', $data->startDate);
            })
            ->join('type_rooms', 'rooms.type_room_id', '=', 'type_rooms.id')
            ->select(
                'rooms.id as id',
                'rooms.name as name',
                'type_rooms.name as name_type_room'
            );

        return $query->get();
    }

    public function checkRoomWhenBooking($typeRoom)
    {
        return DB::table('type_rooms')->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
            ->leftJoin('order_detail', 'rooms.id', '=', 'order_detail.room_id')
            ->where('rooms.status_id', '!=', 4)
            ->where('type_rooms.id', $typeRoom->id)
            ->whereNull('start_date');
    }

    public function createOrUpdate($order, $id = null)
    {
        $action = $this->order->find($id)?? new Order();

        $action->user_id = $order->user_id;
        $action->status_order_id = $order->status_order_id;
        $action->payment_method = $order->payment_method;
        $action->quantity = $order->quantity;
        $action->promotion = $order->promotion;
        $action->total = $order->total;
        $action->payment_total = $order->payment_total;
        $action->date = Carbon::now()->format('Y-m-d');

        $action->save();
    }

    public function createOrUpdateOrderTypeRoom($id, $typeRoom, $number_room, $orderId = null)
    {
        $action =$this->orderTypeRoom->whereOrderId($orderId)->first()?? new OrderTypeRoom();
        $action->order_id = $id;
        $action->type_room_id = $typeRoom['typeRoom']->id;
        $action->number_people = $typeRoom['number_people'];
        $action->number_room= $number_room;
        $action->price = $typeRoom['price'];
        $action->sale = $typeRoom['sale'];
        $action->total = $typeRoom['total'];
        $action->start_date = $typeRoom['startDate'];
        $action->end_date = $typeRoom['endDate'];

        $action->save();
    }

    public function sendMailBooking($customer, $card)
    {
        Mail::send('client.template.booking', [
            'customer' => $customer,
            'card' => $card
        ], function ($message) use ($customer) {
            $message->to($customer['email'], $customer['name'])->subject('BookingNotification Success');
        });
    }

    public function deleteOrder($order)
    {
        return $this->order->find($order->id)->delete();
    }

    public function createOrUpdateOrderDetail($order, $id = null)
    {
        $action = $this->orderDetail->find($id) ?? new OrderDetail();
        $action->order_type_room_id = $order->order_type_room_id;
        $action->room_id = $order->room_id;
        $action->date = Carbon::now()->format('Y-m-d');
        $action->start_date = $order->start_date;
        $action->end_date = $order->end_date;

        $action->save();
    }

    public function getOrderDetailsByOrder($order)
    {
        $query =  DB::table('orders')->join('order_type_room', 'orders.id', '=', 'order_type_room.order_id')
                                ->join('type_rooms', 'order_type_room.type_room_id', '=', 'type_rooms.id')
                                ->join('order_detail', 'order_type_room.id', '=', 'order_detail.order_type_room_id')
                                ->join('rooms', 'order_detail.room_id', '=', 'rooms.id')
                                ->where('orders.id', $order->id);
        if ($order->status_order_id === self::HANDLED) {
            $query->where('orders.status_order_id', self::HANDLED);
        } else {
            $query->where('orders.status_order_id', self::WAIT);

        }

        return $query->select(
            'orders.promotion as promotion',
            'orders.total as total',
            'orders.payment_total as paymentToTal',
            'type_rooms.name as nameTypeRoom',
            'type_rooms.price as price',
            'type_rooms.sale as sale',
            'type_rooms.people as numberPeople',
            'rooms.name as nameRoom'
        )->get();
    }

    public function getOrderTypeRoomsByOrder($order)
    {
        return $this->orderTypeRoom->whereOrderId($order->id)->get();
    }

    public function deleteOrderDetailByOrderTypeRoom($orderTypeRoomId)
    {
        return $this->orderDetail->whereOrderTypeRoomId($orderTypeRoomId)->delete();
    }

    public function deleteOrderTypeRoom($order)
    {
        return DB::table('order_type_room')
            ->where('order_id', $order->id)
            ->join('order_detail', 'order_type_room.id', '=', 'order_detail.order_type_room_id')
            ->delete();
    }

    public function find($id)
    {
        return $this->order->find($id);
    }

    public function findOrderTypeRoom($id)
    {
        return $this->orderTypeRoom->find($id);
    }

    public function getOrdersByUser($userId)
    {
        return $this->order->whereUserId($userId)->paginate(5);
    }

    public function searchHistory($data, $userId)
    {
        if ($data->from && !$data->to) {
            return $this->order->where('date', '>=', $data->from)
                ->whereUserId($userId)
                ->paginate(5);
        }
        if (!$data->from && $data->to) {
            return $this->order->where('date', '<=', $data->to)
                ->whereUserId($userId)
                ->paginate(5);
        }
        if (!$data->from && !$data->to) {
            return $this->order->whereUserId($userId)->paginate(5);
        }

        return $this->order->where('date', '>=', $data->from)
                            ->where('date', '<=', $data->to)->whereUserId($userId)->paginate(5);
    }
}
