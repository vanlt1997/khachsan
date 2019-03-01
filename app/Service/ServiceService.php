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
        return $this->service->whereStatus(1)->get();
    }

    public function getAllList()
    {
        return $this->service->all();
    }

    public function createOrUpdateService($service, $id = null)
    {
        $action = $this->service->find($id) ?? new Service();
        $action->name = $service->name;
        $action->status = $service->status;
        $action->price = $service->price;
        $action->sale = $service->sale;
        $action->quantity = $service->quantity;
        $action->description = $service->description;
        $action->save();
    }

    public function find($id)
    {
        return $this->service->find($id);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
