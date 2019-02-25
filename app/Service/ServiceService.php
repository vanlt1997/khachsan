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
        return $this->service->orderBy('id','desc')->get();
    }

    public function find($id)
    {
        return $this->service->find($id);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function create($service)
    {
        return $this->service->create([
            'name' => $service->name,
        ]);
    }

    public function getFirst()
    {
        return $this->getServices()->first();
    }

    public function update($service)
    {
        return $this->find($service->id)->update([
           'name' => $service->name
        ]);
    }
}
