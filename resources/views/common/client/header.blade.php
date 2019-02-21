<?php
    use App\Models\TypeRoom;
    use App\Models\Service;

    $type_rooms = TypeRoom::all();
    $services = Service::all();
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('trang-chu')}}">Hotel MayStar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{route('trang-chu')}}" class="nav-link">TRANG CHỦ</a></li>
                <li class="nav-item"><a href="{{route('gioi-thieu')}}" class="nav-link">GIỚI THIỆU</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('loai-phong')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LOẠI PHÒNG & GIÁ</a>
                    @if($type_rooms->count() > 0)
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($type_rooms as $type_room)
                                <a class="dropdown-item" href="{{route('chi-tiet-loai-phong',$type_room->aliases)}}">Phòng {{$type_room->name}}</a>
                            @endforeach
                                <a class="dropdown-item" href="{{route('loai-phong')}}">Xem tất cả</a>
                    </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('dich-vu')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DỊCH VỤ KHÁCH SẠN</a>
                    @if($services->count() > 0)
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($services as $service)
                                @if($service->status !== 0)
                                <a class="dropdown-item" href="{{route('chi-tiet-dich-vu',$service->aliases)}}">{{$service->name}}</a>
                                @endif
                            @endforeach
                            <a class="dropdown-item" href="{{route('dich-vu')}}">Xem tất cả</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item"><a href="{{route('lien-he')}}" class="nav-link">LIÊN HỆ</a></li>
                <li class="nav-item"><a href="{{route('uu-dai')}}" class="nav-link">ƯU ĐÃI</a></li>
                <li class="nav-item"><a href="blog.html" class="nav-link">ĐĂNG KÝ</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">ĐĂNG NHẬP</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
