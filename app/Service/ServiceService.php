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

    public function getAllList()
    {
        return $this->service->all();
    }

    public function createOrUpdateService($service, $id = null)
    {
        $action = $this->service->find($id) ?? new Service();
        $action->name = $service->name;
        $action->description = $service->description;
        $action->icon = $service->icon ?? null;
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
