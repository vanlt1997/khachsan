<?php

namespace App\Service;

use App\Models\OrderDetail;
use Carbon\Carbon;

class CalendarService
{
    protected $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function rooms()
    {
        return $this->orderDetail->where('start_date', '>=', Carbon::now()->format('Y-m-d'))
            ->orWhere('end_date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();
    }

}
