<h3>Thank {{$customer['name']}} booked room of us . We will phone with us for confirm.</h3>
<h4>Infomation type room</h4>
</br>
<p>Payment method : {{$customer['payment']->name}}</p>
<p>Name : {{$customer['name']}}</p>
<p>Phone : {{$customer['phone']}}</p>
<p>Sex : {{$customer['sex']}}</p>
<p>Address : {{$customer['address']}}</p>
</br>
<table border="1" cellpadding="15px" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Sale (%)</th>
            <th>Total</th>
            <th>Checkin</th>
            <th>Checkout</th>
        </tr>
    </thead>
    <tbody>
        @foreach($card->typeRooms as $typeRoom)
            <tr>
                <td>{{$typeRoom['typeRoom']->name}}</td>
                <td>$ {{$typeRoom['price']}}</td>
                <td>{{$typeRoom['sale']}} %</td>
                <td>$ {{$typeRoom['total']}}</td>
                <td>{{$typeRoom['startDate']}}</td>
                <td>{{$typeRoom['endDate']}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">Total</td>
            <td>$ {{$card->total}}</td>
        </tr>
        <tr>
            <td colspan="5">Promotion</td>
            <td>$ {{$card->promotion}}</td>
        </tr>
        <tr>
            <td colspan="5">Payment Total</td>
            <td>$ {{$card->paymentTotal}}</td>
        </tr>
    </tbody>
</table>
<br>
<h4>All information please contact with us</h4>
<p class="text-primary">Email: maystarhotel@gmail.com</p>
<p class="text-primary">Hotline : 0335833102</p>
<p class="text-primary">Address: Hotel MayStar, Da Nang</p>
<p class="text-primary">Website: <a href="http://127.0.0.1:8000">maystar.com</a> </p>
<br>
<h4>Thank you for welcom MayStar</h4>

