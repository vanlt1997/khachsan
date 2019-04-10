<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $typeRooms = null;
    protected $sumRoom = 0;
    protected $paymentTotal = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->typeRooms = $oldCart->typeRooms;
            $this->sumRoom = $oldCart->sumRoom;
            $this->paymentTotal = $oldCart->paymentTotal;
        }
    }

    public function addTypeRoom($id, $typeRoom, $startDate, $endDate, $number_people, $number_room)
    {
        $cart = ['number_room' => $number_room, 'price' => $typeRoom->price, 'sale' => $typeRoom->sale,
                 'typeRoom' => $typeRoom, 'startDate' => $startDate, 'endDate'=> $endDate,
                 'number_people' => $number_people, 'total' => 0];
        if ($this->typeRooms) {
            if (array_key_exists($id, $this->typeRooms)) {
                $cart = $this->typeRooms[$id];
            }
        }
        $startDate = $startDate ? Carbon::parse($cart['startDate']): 0;
        $endDate = $endDate ? Carbon::parse($cart['endDate']) : 0;
        $sum_day= $startDate && $endDate ? (int)($endDate->diffInDays($startDate)) : 0;
        if ($typeRoom->sale !== null && $typeRoom->sale > 0) {
            $cart['total'] = $typeRoom->price*$cart['number_room'].$sum_day*(100 + $typeRoom->sale)/100;
        } else {
            $cart['total'] = $typeRoom->price*$cart['number_room'].$sum_day;
        }
        $this->typeRooms[$id] = $cart;
        $this->sumRoom++;
        $this->paymentTotal += $cart['total'];
    }

    /*public function delete($id)
    {
        $this->sumRoom--;
        $this->paymentTotal -=$this->typeRooms[$id]['price'];
        unset($this->typeRooms[$id]);
    }*/

    /*public function update($id, $startDate, $endDate, $number_people)
    {
        $cart = $this->typeRooms[$id];
        $cart['startDate'] = $startDate;
        $cart['endDate'] = $endDate;
        $cart['number_people'] = $number_people;
        $startDate = Carbon::parse($cart['startDate']);
        $endDate = Carbon::parse($cart['endDate']);
        $sum_day= (int)($endDate->diffInDays($startDate));
        if ($cart['sale'] !== null && $cart['sale'] > 0) {
            $cart['total'] = $cart['price']*$cart['number_typeRoom'].$sum_day*(100 + $cart['sale'] )/100;
        } else {
            $cart['total'] = $cart['price']*$cart['number_typeRoom'].$sum_day;
        }
        $this->typeRooms[$id] = $cart;
        $this->sumRoom++;
        $this->paymentTotal += $cart['total'];
    }*/
}