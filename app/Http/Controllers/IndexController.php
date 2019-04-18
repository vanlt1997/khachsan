<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\SearchRoomRequest;
use App\Models\Card;
use App\Models\Order;
use App\Models\User;
use App\Service\ContactService;
use App\Service\OrderService;
use App\Models\Service;
use App\Models\TypeRoom;
use App\Service\ImageService;
use App\Service\PaymentService;
use App\Service\PromotionService;
use App\Service\ServiceService;
use App\Service\SlideBarService;
use App\Service\TypeRoomService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class IndexController extends Controller
{
    const WAIT = 1;

    protected $slideBarService;
    protected $serviceService;
    protected $typeRoomService;
    protected $imageService;
    protected $promotionService;
    protected $contactService;
    protected $orderService;
    protected $paymentService;
    protected $userService;

    public function __construct(
        SlideBarService $slideBarService,
        ServiceService $serviceService,
        TypeRoomService $typeRoomService,
        ImageService $imageService,
        PromotionService $promotionService,
        ContactService $contactService,
        OrderService $orderService,
        PaymentService $paymentService,
        UserService $userService
    ) {
        $this->slideBarService = $slideBarService;
        $this->serviceService = $serviceService;
        $this->typeRoomService = $typeRoomService;
        $this->imageService = $imageService;
        $this->promotionService = $promotionService;
        $this->contactService = $contactService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->userService = $userService;
        session_start();
    }

    public function index()
    {
        $services = $this->serviceService->getServices();
        $slidebars = $this->slideBarService->getSlideBars();
        $typeRooms = $this->typeRoomService->getTypeRooms();
        $images = $this->imageService->getImagesFooter();

        return view('client.index', compact('services', 'slidebars', 'typeRooms', 'images'));
    }

    public function typeRoom()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $typeRooms = $this->typeRoomService->getTypeRooms();

        return view('client.typeroom.index', compact('slidebars', 'images', 'typeRooms'));
    }

    public function detailTypeRoom(TypeRoom $typeRoom)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.typeroom.detail', compact('typeRoom', 'slidebars', 'images'));
    }

    public function services()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $services = $this->serviceService->getServices();
        $images = $this->imageService->getImagesFooter();

        return view('client.service.index', compact('slidebars', 'services', 'images'));
    }

    public function detailService(Service $service)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.service.detail', compact('service', 'slidebars', 'images'));
    }

    public function introduction()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.introduction', compact('slidebars', 'images'));
    }

    public function contact()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        return view('client.contact', compact('slidebars', 'images'));
    }

    public function sendMail(ContactRequest $request)
    {
        $this->contactService->sendMail($request);

        return redirect()->back()->with('message', 'Thank you for contact with us !');
    }

    public function promotion()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $promotions = $this->promotionService->getPromotions();

        return view('client.promotion', compact('slidebars', 'images', 'promotions'));
    }

    public function searchRoom(SearchRoomRequest $request)
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $typeRooms = $this->orderService->actionQuery($request);
        $totalPeople = 0;
        foreach ($typeRooms as $typeRoom) {
            $totalPeople += (int)$typeRoom->total_room*(int)$typeRoom->number_people;
        }

        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !');
        }

        return view('client.typeroom.search-type-room', compact('slidebars', 'images', 'typeRooms', 'request'));
    }

    public function searchRoomOfDetailTypeRoom(TypeRoom $typeRoom, SearchRoomRequest $request)
    {
        $typeRooms = $this->orderService->actionQuery($request);
        $totalPeople = (int)$typeRooms[0]->total_room*(int)$typeRooms[0]->number_people;
        $total_room = $typeRooms[0]->total_room;
        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !');
        }

        return redirect()->route('client.typerooms.detail', $typeRoom->id)
            ->with('message', "Have $total_room rooms you can choose !")->withInput();
    }

    public function checkCodePromotion(Request $request)
    {
        $card = Session::get('card');
        $promotion = $this->promotionService->checkCode(trim($request->promotion));
        if (!$promotion) {
            $card->promotion = 0;
            Session::put('card', $card);
            Session::put('code', ['code' => $request->promotion, 'price' => 0]);
            return redirect()->back()->with('checkCode', 'Code don\'t use')->withInput();
        }
        $card->promotion = $promotion->sale;
        Session::put('card', $card);
        Session::put('code', ['code' => $request->promotion, 'price' => $promotion->sale]);

        return redirect()->back()->withInput();
    }

    public function listTypeRoomBook()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $card = Session::get('card');
        return view('client.book.index', compact('card', 'images', 'slidebars'));
    }

    public function booking(TypeRoom $typeRoom, $startDate = null, $endDate = null, $number_people = 1)
    {
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $promotion = Session::has('code') ? Session::get('code')['price'] : null;
        $card->addTypeRoom($typeRoom->id, $typeRoom, $startDate, $endDate, $number_people, $promotion);
        Session::put('card', $card);
        return redirect()->back();
    }

    public function editTypeRoom(TypeRoom $typeRoom, SearchRoomRequest $request)
    {
        $typeRooms = $this->orderService->actionQuery($request);
        $nameType = $typeRoom->name;
        $totalPeople = (int)$typeRooms[0]->total_room*(int)$typeRooms[0]->number_people;
        $total_room = $typeRooms[0]->total_room;
        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !')->withInput();
        }
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $promotion = Session::has('code') ? Session::get('code')['price'] : 0;
        $card->updateTypeRoom($typeRoom->id, $typeRoom, $request->startDate, $request->endDate, $request->number_people, $promotion);
        Session::put('card', $card);

        return redirect()->route('client.booking')->with('message', "Have $total_room type $nameType  you can choose !")
            ->withInput();
    }

    public function deleteTypeRoom(TypeRoom $typeRoom)
    {
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $card->deleteTypeRoom($typeRoom->id);
        if (count($card->typeRooms) > 0) {
            Session::put('card', $card);
        } else {
            Session::forget('card');
            Session::forget('code');
        }
        return redirect()->back();
    }

    public function deleteTypeRooms()
    {
        session()->forget('card');
        session()->forget('code');

        return redirect()->back();
    }

    public function infoCustomer()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $payments = $this->paymentService->payments();
        $card = Session::get('card');

        return view('client.book.info-booking', compact('slidebars', 'images', 'card', 'payments'));
    }

    public function confirm(PaymentRequest $request)
    {
        Session::forget('infoBooking');
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $paymentMethod =$this->paymentService->find($request->payment);
        $infoBooling = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'address' => $request->address,
            'payment' => $paymentMethod
        ];
        Session::put('infoBooking', $infoBooling);
        $info = Session::get('infoBooking');
        $card = Session::get('card');

        return view('client.book.confirm', compact('info', 'slidebars', 'images', 'card'));
    }

    public function finish()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        $card = Session::get('card');
        $customer = Session::get('infoBooking');
        $promotion = Session::get('code');
        $newUser = $this->userService->getUserByEmai($customer['email']);
        if (!$newUser) {
            $this->userService->createOrUpdate($customer);
        }
        $order = new Order();
        $newUser = $this->userService->getUserByEmai($customer['email']);
        $order->user_id = $newUser->id;
        $order->status_order_id =self::WAIT;
        $order->payment_method = $customer['payment']->name;
        $order->quantity = $card->sumRoom;
        $order->promotion = $promotion['price']??0;
        $order->total = $card->total;
        $order->payment_total = $card->paymentTotal;
        $order->date = Carbon::now()->format('Y-m-d');

        DB::transaction(function () use ($order, $card, $customer) {
            $this->orderService->createOrUpdate($order);
            $orderID = Order::max('id');
            foreach ($card->typeRooms as $typeRoom) {
                $this->orderService->createOrUpdateOrderTypeRoom($orderID, $typeRoom, 0);
            }
            $this->orderService->sendMailBooking($customer, $card);
        });
        Session::forget('card');
        Session::forget('infoBooking');
        Session::forget('code');

        return view('client.book.finish', compact('slidebars', 'images'));
    }
}
