<?php
/**
 * Created by PhpStorm.
 * User: levan
 * Date: 30/03/2019
 * Time: 11:26
 */

namespace App\Service;

use App\Models\Order;
use App\Models\Room;
use App\Models\TypeRoom;
use Illuminate\Support\Facades\DB;

class OrderService
{
    const STATUS_ROOM = [3, 4];
    protected $order;
    protected $typeRoom;
    protected $room;

    public function __construct(Order $order, TypeRoom $typeRoom, Room $room)
    {
        $this->order = $order;
        $this->typeRoom = $typeRoom;
        $this->room = $room;
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


}
