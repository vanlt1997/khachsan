<?php
/**
 * Created by PhpStorm.
 * User: Le Van
 * Date: 3/17/2019
 * Time: 10:27 AM
 */

namespace App\Service;


use App\Models\Promotion;
use Carbon\Carbon;

class PromotionService
{
    protected $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    public function getPromotions()
    {
        $dateNow = Carbon::now()->format('Y-m-d');

        return $this->promotion->where('endDate', '>', $dateNow)->get();
    }

    public function createOrUpdate($promotion, $id = null)
    {
        $action = $this->promotion->find($id)?? new Promotion();
        $action->title = $promotion->title;
        $action->sale = $promotion->sale;
        $action->startDate = $promotion->startDate;
        $action->endDate = $promotion->endDate;
        $action->description = $promotion->description;
        $action->save();
    }

    public function delete($promotionId)
    {
        return $this->promotion->find($promotionId)->delete();
    }
}
