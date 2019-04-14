<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\SearchRoomRequest;
use App\Models\Cart;
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
        $typeRooms = $this->orderService->actionQuery($request, 'client');
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
        $typeRooms = $this->orderService->actionQuery($request, 'client');
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
        $cart = Session::get('cart');
        $promotion = $this->promotionService->checkCode(trim($request->promotion));
        if (!$promotion) {
            $cart->promotion = 0;
            Session::put('cart', $cart);
            Session::put('code', ['code' => $request->promotion, 'price' => 0]);
            return redirect()->back()->with('checkCode', 'Code don\'t use')->withInput();
        }
        $cart->promotion = $promotion->sale;
        Session::put('cart', $cart);
        Session::put('code', ['code' => $request->promotion, 'price' => $promotion->sale]);

        return redirect()->back()->withInput();
    }

    public function listTypeRoomBook()
    {
//        Session::forget('cart');
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $cart = Session::get('cart');
        return view('client.book.index', compact('cart', 'images', 'slidebars'));
    }

    public function booking(TypeRoom $typeRoom, $startDate = null, $endDate = null, $number_people = 1)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $promotion = Session::has('code') ? Session::get('code')['price'] : null;
        $cart->addTypeRoom($typeRoom->id, $typeRoom, $startDate, $endDate, $number_people, $promotion);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function editTypeRoom(TypeRoom $typeRoom, SearchRoomRequest $request)
    {
        $typeRooms = $this->orderService->actionQuery($request, 'client');
        $nameType = $typeRoom->name;
        $totalPeople = (int)$typeRooms[0]->total_room*(int)$typeRooms[0]->number_people;
        $total_room = $typeRooms[0]->total_room;
        if ($totalPeople < $request->number_people) {
            return redirect()->back()->with('error', 'Haven\'t room for you !')->withInput();
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $promotion = Session::has('code') ? Session::get('code')['price'] : 0;
        $cart->updateTypeRoom($typeRoom->id, $typeRoom, $request->startDate, $request->endDate, $request->number_people, $promotion);
        Session::put('cart', $cart);

        return redirect()->route('client.booking')->with('message', "Have $total_room type $nameType  you can choose !")
            ->withInput();
    }

    public function deleteTypeRoom(TypeRoom $typeRoom)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deleteTypeRoom($typeRoom->id);
        if (count($cart->typeRooms) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
            Session::forget('code');
        }
        return redirect()->back();
    }

    public function deleteTypeRooms()
    {
        session()->forget('cart');
        session()->forget('code');

        return redirect()->back();
    }

    public function infoCustomer()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();
        $payments = $this->paymentService->payments();
        $cart = Session::get('cart');

        return view('client.book.info-booking', compact('slidebars', 'images', 'cart', 'payments'));
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
        $cart = Session::get('cart');

        return view('client.book.confirm', compact('info', 'slidebars', 'images', 'cart'));
    }

    public function finish()
    {
        $slidebars = $this->slideBarService->getSlideBars();
        $images = $this->imageService->getImagesFooter();

        $cart = Session::get('cart');
        $customer = Session::get('infoBooking');
        $promotion = Session::get('code');
        $user = $this->userService->find($customer['email']);
        if (!$user) {
            $this->userService->createOrUpdate($customer);
        }
        $newUser = $this->userService->getUserByEmai($customer['email']);
        $order = new Order();
        $order->user_id = $newUser->id;
        $order->status_order_id =self::WAIT;
        $order->payment_method = $customer['payment']->name;
        $order->quantity = $cart->sumRoom;
        $order->promotion = $promotion['price']??0;
        $order->total = $cart->total;
        $order->payment_total = $cart->paymentTotal;
        $order->date = Carbon::now()->format('Y-m-d');

        $this->orderService->createOrUpdate($order);
        $orderID = Order::max('id');
        foreach ($cart->typeRooms as $typeRoom) {
            $this->orderService->createOrderTypeRoom($orderID, $typeRoom);
        }

        $this->orderService->sendMailBooking($customer, $cart);
        Session::forget('cart');
        Session::forget('infoBooking');
        Session::forget('code');

        return view('client.book.finish', compact('slidebars', 'images'));
    }
}
