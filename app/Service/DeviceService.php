<?php

namespace App\Service;

use App\Models\Device;

class DeviceService
{
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function getDevices()
    {
        return $this->device->all();
    }

    public function createOrUpdate($device, $id = null)
    {
        $action = $this->device->find($id)?? new Device();
        $action->name = $device->name;
        $action->quantity = $device->quantity;
        $action->save();
    }

    public function find($id)
    {
        return $this->device->find($id);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
