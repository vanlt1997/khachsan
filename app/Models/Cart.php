<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $typeRooms;
    protected $sumRoom = 0;
    protected $paymentTotal = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->typeRooms = $oldCart->typeRoom;
            $this->sumRoom = $oldCart->sumRoom;
            $this->paymentTotal = $oldCart->paymentTotal;
        }
    }

}
