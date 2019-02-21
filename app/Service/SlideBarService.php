<?php

namespace App\Service;


use App\Models\SlideBar;

class SlideBarService
{
    protected $slideBar;

    public function __construct(SlideBar $slideBar)
    {
        $this->slideBar = $slideBar;
    }

    public function getSlideBars()
    {
        return $this->slideBar->all();
    }
}
