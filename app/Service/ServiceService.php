<?php

namespace App\Service;


use App\Models\Service;

class ServiceService
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function getServices()
    {
        return $this->service->all();
    }
}
