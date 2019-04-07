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


    public function showRoom($data)
    {
        if ($data->typeRoom === null) {
            $query = $this->room->whereNotIn('status_id', self::STATUS_ROOM);
        } else {
            $query = $this->room->whereTypeRoomId($data->typeRoom)->whereNotIn('status_id', self::STATUS_ROOM);
        }
        $query->with(['orderDetails' => function ($query) use ($data) {
            $query->where('start_date', '>=', $data->endDate)->orWhere('end_date', '<=', $data->startDate);
        }]);

        return $query->get();
    }
}
