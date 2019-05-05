<?php

use App\Models\TypeRoom;
use App\Models\Service;

$type_rooms = TypeRoom::all();
$services = Service::all();
?>
<style>
    .nav-item {
        font-weight: 700;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('client.index')}}">Hotel MayStar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{route('client.index')}}" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="{{route('client.introduction')}}" class="nav-link">INTRODUCE</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('client.typerooms.index')}}" id="dropdown04"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ROOMS & PRICE</a>
                    @if($type_rooms->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($type_rooms as $type_room)
                                <a class="dropdown-item"
                                   href="{{route('client.typerooms.detail',$type_room->id)}}">Room {{$type_room->name}}</a>
                            @endforeach
                            <a class="dropdown-item" href="{{route('client.typerooms.index')}}">All Room ...</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('client.services.index')}}" id="dropdown04"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICE</a>
                    @if($services->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($services as $service)
                                @if($service->status !== 0)
                                    <a class="dropdown-item"
                                       href="{{route('client.services.detail',$service->id)}}">{{$service->name}}</a>
                                @endif
                            @endforeach
                            <a class="dropdown-item" href="{{route('client.services.index')}}">All service ...</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item"><a href="{{route('client.contact')}}" class="nav-link">CONTACT</a></li>
                <li class="nav-item"><a href="{{route('client.promotions')}}" class="nav-link">PROMOTIONS</a></li>
                <li class="nav-item"><a href="{{route('client.booking')}}" class="nav-link">@if(Session::has('card'))
                            <span class="badge badge-pill badge-danger">{{Session::get('card')->sumRoom}}</span> @else
                            <span class="badge badge-pill badge-danger">0</span>@endif BOOKING</a></li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">REGISTRATION</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item submenu dropdown">
                        <a class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                            HELLO : {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->role == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.index')}}" style="color: black">Go To Admin</a>
                                </li>
                            @endif
                            @if(Auth::user()->role != 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('client.information')}}" style="color: black">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('client.history')}}" style="color: black">History</a>
                                </li>
                            @endif
                            <li class="nav-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><a href="{{ route('logout') }}"
                                                                             class="nav-link"
                                                                             style="color: black">{{ __('Logout') }}</a>
                            </li>

                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
