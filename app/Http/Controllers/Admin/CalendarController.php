<?php

namespace App\Http\Controllers\Admin;

use App\Service\CalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Json;

class CalendarController extends Controller
{
    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function index()
    {
        $rooms = $this->calendarService->rooms();
        $data = [];
        foreach ($rooms as $room) {
            $data[] = [
                $room->room->typeRoom->name,
                'Room '.$room->room->name,
                Carbon::parse($room->start_date),
                Carbon::parse($room->end_date)
            ];
        }

        return view('admin.calendar.room', compact('data'));
    }
}
