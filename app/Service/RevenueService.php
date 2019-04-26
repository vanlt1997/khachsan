<?php

namespace App\Service;


use App\Models\Order;
use Illuminate\Support\Facades\DB;

class RevenueService
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function reportMonth()
    {
        return DB::table('orders')->select(DB::raw('SUM(payment_total) as total, MONTH(date) as month'))
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();
    }

    public function reportQuarterly()
    {
        return DB::table('orders')->select(DB::raw('SUM(payment_total) as total, QUARTER(date) as quarter'))
            ->groupBy(DB::raw('QUARTER(date)'))
            ->get();
    }

}
