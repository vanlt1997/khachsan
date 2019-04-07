<?php

namespace App\Service;


use App\Models\Payment;

class PaymentService
{
    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function payments()
    {
        return $this->payment->all();
    }
}
