<?php

namespace App\Http\Controllers\Admin;

use App\Service\ContactService;
use App\Service\PromotionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    protected $contactService;
    protected $promotionService;

    public function __construct(ContactService $contactService, PromotionService $promotionService)
    {
        $this->contactService = $contactService;
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        return view('admin.contact.index');
    }

    public function getList()
    {
        return DataTables::of($this->contactService->contacts())->make(true);
    }

    public function delete(Request $request)
    {
        $this->contactService->delete($request->contactIds);

        return response()->json(null, 204);
    }

    public function sendMail(Request $request)
    {
        $promotions = $this->promotionService->getPromotions();
        $count = $this->contactService->sendMailFromAdmin($request->Ids, $promotions);

        return response()->json($count, 200);
    }
}
