<?php

namespace App\Service;


use App\Models\Status;

class StatusService
{
    protected $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status->all();
    }
}
