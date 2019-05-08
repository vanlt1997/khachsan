<?php

namespace App\Service;


use App\Models\Service;
use App\Models\ImageService;

class ServiceService
{
    protected $service;
    protected $imageService;

    public function __construct(Service $service, ImageService $imageService)
    {
        $this->service = $service;
        $this->imageService = $imageService;

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

    public function getItemLast()
    {
        return $this->service->all()->last();
    }
}
