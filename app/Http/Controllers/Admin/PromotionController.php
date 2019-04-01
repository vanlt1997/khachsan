<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Service\PromotionService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        return view('admin.promotion.index');
    }

    public function getList()
    {
        $promotions = $this->promotionService->promotions();
        return DataTables::of($promotions)
            ->editColumn('startDate', function ($promotions) {
                return $promotions->startDate ? with(new Carbon($promotions->startDate))->format('Y-m-d') : '';
            })
            ->editColumn('endDate', function ($promotions) {
                return $promotions->endDate ? with(new Carbon($promotions->endDate))->format('Y-m-d') : '';
            })
            ->addColumn('action', function ($promotion) {
                return
                    '<a href="promotions/' . $promotion->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="promotions/' . $promotion->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make(true);
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.form', compact('promotion'));
    }

    public function actionEdit(Promotion $promotion, PromotionRequest $request)
    {
        $this->promotionService->createOrUpdate($request, $promotion->id);

        return redirect()->route('admin.promotions.index')->with('message', 'Edit Promotion Successfully !');
    }

    public function create()
    {
        return view('admin.promotion.form');
    }

    public function actionCreate(PromotionRequest $request)
    {
        $this->promotionService->createOrUpdate($request);

        return redirect()->route('admin.promotions.index')->with('message', 'Create Promotion Successfully !');
    }


    public function delete(Promotion $promotion)
    {
        if (Carbon::now()->format('Y-m-d') > $promotion->endDate && !$promotion->orders->isEmpty()) {
            return redirect()->route('admin.promotions.index')->with('error', 'You Can\'t Delete Promotion !');
        } else {
            $this->promotionService->delete($promotion->id);
        }

        return redirect()->route('admin.promotions.index')->with('message', 'Delete Promotion Successfully !');
    }

    public function sendMail(Request $request)
    {
        $count = $this->promotionService->sendMailByPromotion($request->Ids);

        return response()->json($count, 200);
    }
}
