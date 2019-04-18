<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $typeRooms = null;
    public $sumRoom = 0;
    public $total = 0;
    public $promotion = 0;
    public $paymentTotal = 0;

    public function __construct($oldCard)
    {
        if ($oldCard) {
            $this->typeRooms = $oldCard->typeRooms;
            $this->sumRoom = $oldCard->sumRoom;
            $this->paymentTotal = $oldCard->paymentTotal;
            $this->promotion = $oldCard->promotion;
            $this->total = $oldCard->total;
        }
    }

    public function addTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion = null, $rooms = [])
    {
        $card = ['price' => $typeRoom->price, 'sale' => $typeRoom->sale ?? 0,
                 'typeRoom' => $typeRoom, 'startDate' => $startDate, 'endDate'=> $endDate,
                 'number_people' => $number_people ?? 1, 'total' => 0, 'rooms' => null];
        if ($this->typeRooms) {
            if (array_key_exists($id, $this->typeRooms)) {
                $this->deleteTypeRoom($id);
            }
        }
        $startDate = $startDate !== null ? Carbon::parse($card['startDate']): 0;
        $endDate = $endDate !== null ? Carbon::parse($card['endDate']) : 0;
        $sum_day= $startDate && $endDate ? (int)($endDate->diffInDays($startDate)) : 0;
        if ($typeRoom->sale > 0) {
            $card['total'] = $typeRoom->price*$card['number_people']*$sum_day*(100 - $typeRoom->sale)/100;
        } else {
            $card['total'] = $typeRoom->price*$card['number_people']*$sum_day;
        }

        $this->typeRooms[$id] = $card;
        if ($rooms) {
            foreach ($rooms as $room) {
                $this->typeRooms[$id]['rooms'][$room->id] = $room;
            }
        }

        $this->sumRoom++;
        $this->promotion = $promotion;
        $this->total += $card['total'];
        $this->paymentTotal = $this->total - $this->promotion > 0 ? $this->total - $this->promotion : 0;
    }

    public function deleteTypeRoom($id)
    {
        $this->sumRoom--;
        $this->total -=$this->typeRooms[$id]['total'];
        $this->paymentTotal = $this->total- $this->promotion;
        unset($this->typeRooms[$id]);
    }

    public function updateTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion = null, $rooms = [])
    {
        $this->deleteTypeRoom($id);
        $this->addTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion, $rooms);
    }
}
