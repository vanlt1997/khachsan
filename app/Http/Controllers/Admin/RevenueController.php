<?php

namespace App\Http\Controllers\Admin;

use App\Service\RevenueService;
use App\Service\TypeRoomService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    protected $revenueService;
    protected $typeRoomService;

    public function __construct(RevenueService $revenueService, TypeRoomService $typeRoomService)
    {
        $this->revenueService = $revenueService;
        $this->typeRoomService = $typeRoomService;
    }

    public function reports()
    {
        $data = $this->revenueService->reportMonth();
        $month = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        $chatMonth[] = ['Month', 'Revenue in month'];
        $total = 0;
        foreach ($month as $index => $values) {
            foreach ($data as $key => $item) {
                $total = ($index + 1) === (int)$item->month ? $item->total : 0;
                if ($total > 0) {
                    break;
                }
            }
            $chatMonth[] = [$values, $total];
        }

        $dataQuarter = $this->revenueService->reportQuarterly();
        $quarter = [
            'Quarter I',
            'Quarter II',
            'Quarter III',
            'Quarter IV'
        ];
        $chatQuarter[] = ['Quarter', 'Revenue in quarter'];
        foreach ($quarter as $index => $values) {
            foreach ($dataQuarter as $item) {
                $total = $index +1  === (int)$item->quarter ? $item->total : 0;
                if ($total > 0) {
                    break;
                }
            }
            $chatQuarter[] = [$values, $total];
        }

        return view('admin.revenue.report', compact('chatMonth', 'chatQuarter'));
    }

    public function reportTypeRoom()
    {
        $reportTypeRoomMonths = $this->revenueService->reportTypeRoomMonth();
        $typeRooms = $this->typeRoomService->getTypeRooms();
        $typeRoomNames = [
            'Month',
        ];
        $month = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        foreach ($typeRooms as $typeRoom) {
            $typeRoomNames[] = $typeRoom->name;
        }
        $curveChart[] = $typeRoomNames;
        foreach ($month as $index => $value) {
            $row = [$value];
            foreach ($typeRooms as $typeRoom) {
                foreach ($reportTypeRoomMonths as $reportTypeRoomMonth) {
                    $total = $typeRoom->name === $reportTypeRoomMonth->name  && $index +1 === (int) $reportTypeRoomMonth->month ? $reportTypeRoomMonth->total : 0;
                    if ($total > 0) {
                        break;
                    }
                }
                $row[] = $total;

            }
            $curveChart[] = $row;
        }
        // dd($curveChart);
        $reportTypeRooms = $this->revenueService->reportTypeRoom();
        $chartTypeRooms[] = ['TypeRoom', 'Price'];
        foreach ($reportTypeRooms as $reportTypeRoom) {
            $chartTypeRooms[] = [$reportTypeRoom->name, $reportTypeRoom->total];
        }



        return view('admin.revenue.report-type-room', compact('curveChart', 'chartTypeRooms'));
    }
}
