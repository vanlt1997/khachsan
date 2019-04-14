<?php
/**
 * Created by PhpStorm.
 * User: levan
 * Date: 30/03/2019
 * Time: 11:26
 */

namespace App\Service;

use App\Models\Order;
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
    protected $order;
    protected $typeRoom;
    protected $room;
    protected $orderTypeRoom;

    public function __construct(Order $order, TypeRoom $typeRoom, Room $room, OrderTypeRoom $orderTypeRoom)
    {
        $this->order = $order;
        $this->typeRoom = $typeRoom;
        $this->room = $room;
        $this->orderTypeRoom = $orderTypeRoom;
    }

    public function orders()
    {
        return $this->order->with(['payment', 'user', 'promotions', 'typeRoom', 'statusOrder'])
            ->get();
    }


    public function actionQuery($data, $from = null)
    {
        $query = DB::table('type_rooms')->join('rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
                                        ->leftJoin('order_detail', 'rooms.id', '=', 'order_detail.room_id')
                                        ->where('rooms.status_id', '!=', 4);
        if ($data->typeRoom !== null) {
            $query->where('type_rooms.id', $data->typeRoom);
        }

        if ($from !== null) {
            $query->whereNull('start_date')->orWhere('start_date', '>=', $data->endDate)->orWhere('end_date', '<=', $data->startDate)
                ->select(DB::raw('count(*) as total_room'), 'type_rooms.id as id','type_rooms.name as type_room_name', 'price',
                'type_rooms.people as number_people', 'bed', 'extra_bed', 'acreage', 'view', 'type_rooms.description as description', 'sale')
                ->groupBy('type_rooms.id');
        } else {
            $query->select('type_rooms.name as type_room_name', 'type_rooms.price as price',
                'type_rooms.people as number_people', 'rooms.name as room_name', 'bed', 'start_date', 'end_date',
                'extra_bed', 'acreage', 'view', 'type_rooms.description as description', 'sale');
        }
        return $query->get();
    }

    public function checkRoom($data)
    {
        $rooms = [];
        $totalPeople = 0;
        $listRooms = $this->actionQuery($data);
        foreach ($listRooms as $item) {
            if ($item->start_date == null && $item->end_date == null) {
                $rooms[] = $item;
                $totalPeople+= $item->number_people;
            } elseif ($data->endDate <= $item->start_date || $data->startDate >= $item->end_date) {
                $rooms[] = $item;
                $totalPeople+= $item->number_people;
            }
        }

        return [
            'rooms' => $rooms,
            'total_people' => $totalPeople
        ];
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
        $action->status_order_id = self::WAIT;
        $action->payment_method = $order->payment_method;
        $action->quantity = $order->quantity;
        $action->promotion = $order->promotion;
        $action->total = $order->total;
        $action->payment_total = $order->payment_total;
        $action->date = Carbon::now()->format('Y-m-d');

        $action->save();
    }

    public function createOrderTypeRoom($id, $typeRoom)
    {
        $action = new OrderTypeRoom();
        $action->order_id = $id;
        $action->type_room_id = $typeRoom['typeRoom']->id;
        $action->price = $typeRoom['price'];
        $action->sale = $typeRoom['sale'];
        $action->total = $typeRoom['total'];
        $action->start_date = $typeRoom['startDate'];
        $action->end_date = $typeRoom['endDate'];

        $action->save();
    }

    public function sendMailBooking($customer, $cart)
    {
        Mail::send('client.template.booking', ['customer' => $customer, 'cart' => $cart], function ($message) use ($customer) {
            $message->to($customer['email'], $customer['name'])->subject('Booking Success');
        });
    }

    public function deleteOrder($order)
    {
        return $this->order->find($order->id)->delete();
    }
}
