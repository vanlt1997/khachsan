<?php

namespace App\Service;


use App\Models\StatusOrder;

class StatusOrderService
{
    protected $statusOrder;

    public function __construct(StatusOrder $statusOrder)
    {
        $this->statusOrder = $statusOrder;
    }

    public function statusOrders()
    {
        return $this->statusOrder->all();
    }
}
