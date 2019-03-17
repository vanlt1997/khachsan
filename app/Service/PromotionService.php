<?php
/**
 * Created by PhpStorm.
 * User: Le Van
 * Date: 3/17/2019
 * Time: 10:27 AM
 */

namespace App\Service;


use App\Models\Promotion;

class PromotionService
{
    protected $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    public function getPromotions()
    {
        return $this->promotion->all();
    }
}
