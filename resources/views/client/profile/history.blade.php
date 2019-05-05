@extends('layouts.client')
@section('title','Information User')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url({{asset("images/slidebars/$slidebar->url")}});">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a
                                                href="{{route('client.index')}}">Home</a></span>
                                    <span>History</span></p>
                                <h1 class="mb-3">History Booked</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
<style>
    label{}
</style>
@section('content')
    <section class="ftco-section contact-section" id="contactForm">
        <div class="container bg-light">
            <div class="row d-flex mb-3 contact-info">
                <div class="row col-md-12">
                    <h3 class="text-danger">History booked of {{$user->name}}</h3>
                </div>
            </div>
            <div class="row">
                 <form method="post" class="row col-md-12">
                    @csrf
                    <div class="form-group col-md-5 row">
                        <div class="col-md-2">
                            <label for="from" class="m-3">From</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" name="from" id="from" class="form-control" value="{{$request->from ?? null}}">
                        </div>
                    </div>
                     <div class="form-group col-md-5 row">
                         <div class="col-md-2">
                             <label for="to" class="m-3">To</label>
                         </div>
                         <div class="col-md-10">
                             <input type="date" name="to" id="to" class="form-control" value="{{$request->to ?? null}}">
                         </div>
                     </div>
                     <div class="col-md-2">
                        <button type="submit" class="btn form-control btn-info">Search</button>
                     </div>
                 </form>
            </div>
            <div class="row col-md-12">
                @if(isset($request))
                    <h5 class="text-success"> Result search</h5>
                @endif
            </div>
            <div class="row block-9">
                @foreach($orders as $order)
                    <div class="col-md-12">
                        <h5 class="text-info"><span>&bigstar;</span> Date : {{$order->date}}</h5>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Images</th>
                                <th>Name</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Number people</th>
                                <th>Price</th>
                                <th>Sale (%)</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderTypeRooms as $orderTypeRoom)
                                <tr>
                                    <td>
                                        <img src="{{asset('images/admin/library-images')}}/{{$orderTypeRoom->typeRoom->images->first()['url']}}"
                                             width="100px" height="125px">
                                    </td>
                                    <td>{{$orderTypeRoom->typeRoom->name}}</td>
                                    <td>{{$orderTypeRoom->start_date}}</td>
                                    <td>{{$orderTypeRoom->end_date}}</td>
                                    <td>{{$orderTypeRoom->number_people}}</td>
                                    <td>$ {{$orderTypeRoom->price}}</td>
                                    <td>{{$orderTypeRoom->sale ?? 0}} %</td>
                                    <td>$ {{$orderTypeRoom->total}}</td>
                                </tr>
                            @endforeach
                            <tr class="text-danger">
                                <td colspan="7" class="text-right">Total</td>
                                <td>$ {{$order->total}}</td>
                            </tr>
                            <tr class="text-danger">
                                <td colspan="7" class="text-right">Promotion</td>
                                <td>$ {{$order->promotion}}</td>
                            </tr>
                            <tr class="text-danger">
                                <td colspan="7" class="text-right">Payment Total</td>
                                <td>$ {{$order->payment_total}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                @endforeach
            </div>
            <div class="col-md-12 right">
                {!! $orders->links() !!}
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#contactForm").offset().top
            }, 1000);
        });
    </script>
@endpush
