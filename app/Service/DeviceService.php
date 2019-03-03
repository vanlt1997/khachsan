<?php

namespace App\Service;

use App\Models\Device;
use App\Models\DeviceTypeRoom;
use App\Models\TypeRoom;

class DeviceService
{
    protected $device;
    protected $deviceTypeRoom;
    protected $typeRoom;

    public function __construct(Device $device, DeviceTypeRoom $deviceTypeRoom, TypeRoom $typeRoom)
    {
        $this->device = $device;
        $this->deviceTypeRoom = $deviceTypeRoom;
        $this->typeRoom = $typeRoom;
    }

    public function getDevices()
    {
        return $this->device->all();
    }

    public function getDeviceTypeRoom($id)
    {
        return $this->deviceTypeRoom->whereTypeRoomId($id)->pluck('device_id');
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

    public function saveDeviceTypeRoom($id, $devices)
    {
        $this->deviceTypeRoom->whereTypeRoomId($id)->delete();
        if ($devices !== null)
        {
            foreach ($devices as $device)
            {
                $this->deviceTypeRoom->create([
                    'device_id' => $device,
                    'type_room_id' => $id
                ]);
            }
        }
    }
}
