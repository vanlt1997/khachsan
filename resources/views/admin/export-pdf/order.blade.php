<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="text-danger">Hotel MayStar</h3>
        <h4>Date: {{\Carbon\Carbon::now()->format('Y-m-d H:m:s')}}</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Order : {{$order->user->name}}</h4>
        <p>Email : {{$order->user->email}}</p>
        <p>Phone : {{$order->user->phone}}</p>
        <p>Sex : {{$order->user->sex}}</p>
    </div>
    <div class="col-md-12">
        <h4>Information Order</h4>
        <p>Order Id : {{$order->id}}</p>
        <p>Booking Date : {{$order->date}}</p>
        <p>Payment Method : {{$order->payment_method}}</p>
        <p>Number Type Room : {{$order->quantity}}</p>
        <p>Total : $ {{$order->total}}</p>
        @if($order->promotion > 0)
        <p>Promotion : $ {{$order->promotion}}</p>
        @endif
        <p>Payment Total: $ {{$order->payment_total}}</p>
    </div>
    <div class="col-md-12">
        <h4>Information Detail Order</h4>
        <table border="1" cellspacing="0" cellpadding="15px" width="100%">
            <tr>
                <th>Type Room</th>
                <th>Price</th>
                <th>Sale (%)</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Number people</th>
                <th>Number room</th>
                <th>Total</th>
            </tr>
            @foreach($order->orderTypeRooms as $orderTypeRoom)
                <tr>
                    <td>{{$orderTypeRoom->typeRoom->name}}</td>
                    <td>$ {{$orderTypeRoom->price}}</td>
                    <td>{{$orderTypeRoom->sale}} %</td>
                    <td>{{$orderTypeRoom->start_date}}</td>
                    <td>{{$orderTypeRoom->end_date}}</td>
                    <td>{{$orderTypeRoom->number_people}}</td>
                    <td>{{$orderTypeRoom->number_room}}</td>
                    <td>$ {{$orderTypeRoom->total}}</td>
                </tr>
                <tr>
                    <td colspan="8">
                        <ul>
                            @foreach($orderTypeRoom->orderDetails as $orderDetail)
                                <li>Room : {{$orderDetail->room->name}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-12">
        <br>
        <p class="text-center">-------------------------------------- Thank you for coming with us. See you laster ! --------------------------------------</p>
    </div>
</div>
