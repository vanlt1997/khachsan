<h3>Thank {{$order->user->name}} for our booking </h3>
<strong>But we really apologize for this problem. Your order is now out of room. You can contact us to choose another room.
    Will refund immediately, please kindly check the account. Again, we are really sorry. </strong>
</br>
@if(strtolower($order->payment_method) === 'card')
<h4>Refund Amount : {{$order->payment_total}}</h4>
@endif
<br>
<p>Date: {{\Carbon\Carbon::now()->format('Y-m-d H:m:s')}}</p>
<br>
<h4>All information please contact with us</h4>
<p class="text-primary">Email: maystarhotel@gmail.com</p>
<p class="text-primary">Hotline : 0335833102</p>
<p class="text-primary">Address: Hotel MayStar, Da Nang</p>
<p class="text-primary">Website: <a href="http://quanlykhachsanmaystar.herokuapp.com">quanlykhachsanmaystar.herokuapp.com</a> </p>
<br>
<h4>Thank you for welcome MayStar</h4>

