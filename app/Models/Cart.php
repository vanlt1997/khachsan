<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $typeRooms = null;
    public $sumRoom = 0;
    public $total = 0;
    public $promotion = 0;
    public $paymentTotal = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->typeRooms = $oldCart->typeRooms;
            $this->sumRoom = $oldCart->sumRoom;
            $this->paymentTotal = $oldCart->paymentTotal;
            $this->promotion = $oldCart->promotion;
            $this->total = $oldCart->total;
        }
    }

    public function addTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion = null)
    {
        $cart = ['price' => $typeRoom->price, 'sale' => $typeRoom->sale ?? 0,
                 'typeRoom' => $typeRoom, 'startDate' => $startDate, 'endDate'=> $endDate,
                 'number_people' => $number_people ?? 1, 'total' => 0];
        if ($this->typeRooms) {
            if (array_key_exists($id, $this->typeRooms)) {
                $this->deleteTypeRoom($id);
            }
        }
        $startDate = $startDate !== null ? Carbon::parse($cart['startDate']): 0;
        $endDate = $endDate !== null ? Carbon::parse($cart['endDate']) : 0;
        $sum_day= $startDate && $endDate ? (int)($endDate->diffInDays($startDate)) : 0;
        if ($typeRoom->sale > 0) {
            $cart['total'] = $typeRoom->price*$cart['number_people']*$sum_day*(100 + $typeRoom->sale)/100;
        } else {
            $cart['total'] = $typeRoom->price*$cart['number_people']*$sum_day;
        }

        $this->typeRooms[$id] = $cart;
        $this->sumRoom++;
        $this->promotion = $promotion;
        $this->total += $cart['total'];
        $this->paymentTotal = $this->total- $this->promotion;
    }

    public function deleteTypeRoom($id)
    {
        $this->sumRoom--;
        $this->total -=$this->typeRooms[$id]['total'];
        $this->paymentTotal = $this->total- $this->promotion;
        unset($this->typeRooms[$id]);
    }

    public function updateTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion = null)
    {
        $this->deleteTypeRoom($id);
        $this->addTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $promotion);
    }
}
