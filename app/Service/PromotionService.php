<?php

namespace App\Service;

use App\Models\OrderPromotion;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PromotionService
{
    protected $promotion;
    protected $contactService;
    protected $userService;
    protected $orderPromotion;

    public function __construct(Promotion $promotion, ContactService $contactService, UserService $userService, OrderPromotion $orderPromotion)
    {
        $this->promotion = $promotion;
        $this->contactService = $contactService;
        $this->userService = $userService;
        $this->orderPromotion = $orderPromotion;
    }

    public function promotions()
    {
        return $this->promotion->all();
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
        $action->code = $promotion->code;
        $action->description = $promotion->description;
        $action->save();
    }

    public function delete($promotionId)
    {
        return $this->promotion->whereId($promotionId)->delete();
    }

    public function sendMailByPromotion($Ids)
    {
        $count = 0;
        $users = $this->userService->users();
        $contacts = $this->contactService->contacts();
        $promotions = $this->promotion->whereIn('id', $Ids)->get();

        if (!$users->isEmpty()) {
            foreach ($users as $user) {
                Mail::send('admin.contact.mail-template', ['contact' => $user, 'promotions' => $promotions], function ($message) use ($user) {
                    $message->to($user->email, $user->name)->subject('New Promotions');
                });
                    $count++;
            }
        }

        if (!$contacts->isEmpty()) {
            foreach ($contacts as $contact) {
                Mail::send('admin.contact.mail-template', ['contact' => $contact, 'promotions' => $promotions], function ($message) use ($contact) {
                    $message->to($contact->email, $contact->name)->subject('New Promotions');
                });
                $count++;
            }
        }

        return $count;
    }

    public function checkCode($code)
    {
        return $this->promotion->where('code', '=', $code)
                    ->where('endDate', '>=', Carbon::now()->format('Y-m-d'))
                    ->first();
    }
    public function checkOrderPromotion($promotionsId, $userId)
    {
        return $this->orderPromotion->where('promotion_id', $promotionsId)->where('user_id', $userId)->first();
    }
}
