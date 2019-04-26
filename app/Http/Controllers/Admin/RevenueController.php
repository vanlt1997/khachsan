<?php

namespace App\Http\Controllers\Admin;

use App\Service\RevenueService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    protected $revenueService;

    public function __construct(RevenueService $revenueService)
    {
        $this->revenueService = $revenueService;
    }

    public function reports()
    {
        $data = $this->revenueService->reportMonth()->toArray();
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
}
