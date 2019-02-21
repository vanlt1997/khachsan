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
}
