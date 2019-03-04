<?php
    use App\Models\TypeRoom;
    use App\Models\Service;

    $type_rooms = TypeRoom::all();
    $services = Service::all();
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('client.index')}}">Hotel MayStar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{route('client.index')}}" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="{{route('gioi-thieu')}}" class="nav-link">INTRODUCTION</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('loai-phong')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ROOM & PRICE</a>
                    @if($type_rooms->count() > 0)
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($type_rooms as $type_room)
                                <a class="dropdown-item" href="{{route('chi-tiet-loai-phong',$type_room->aliases)}}">Room {{$type_room->name}}</a>
                            @endforeach
                                <a class="dropdown-item" href="{{route('loai-phong')}}">All Room ...</a>
                    </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('dich-vu')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICE</a>
                    @if($services->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($services as $service)
                                @if($service->status !== 0)
                                <a class="dropdown-item" href="{{route('chi-tiet-dich-vu',$service->aliases)}}">{{$service->name}}</a>
                                @endif
                            @endforeach
                            <a class="dropdown-item" href="{{route('dich-vu')}}">All service ...</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item"><a href="{{route('client.contact')}}" class="nav-link">CONTACT</a></li>
                <li class="nav-item"><a href="{{route('client.promotion')}}" class="nav-link">PROMOTION</a></li>
                <li class="nav-item"><a href="blog.html" class="nav-link">REGISTRATION</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">LOGIN</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
