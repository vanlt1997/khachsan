@extends('layouts.client')
@section('title','Giới Thiệu')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('trang-chu')}}">Trang chủ</a></span> <span>Giới Thiệu</span></p>
                                <h1 class="mb-3">Giới thiệu</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
    <section class="ftco-section-2">
        <div class="container d-flex">
            <div class="section-2-blocks-wrapper row d-flex">
                <div class="img col-sm-12 col-lg-6 order-last" style="background-image: url({{asset('images/about-2.jpg')}});">
                </div>
                <div class="text col-lg-6 order-first ftco-animate">
                    <div class="text-inner align-self-start">
                        <span class="subheading">Giới Thiệu MayStar</span>
                        <h3 class="heading">Chào mừng đến với khách sạn</h3>
                        <p>Nằm ở vị trí tuyệt đẹp ngay giữa trung tâm Đà Nẵng của Việt Nam, MayStar Hotel Đà Nẵng luôn chào đón tất cả các vị khách đang tìm kiếm địa điểm nghỉ chân sang trọng với tiện nghi hàng đầu và dịch vụ chu đáo nhất tại Việt nam.</p>

                        <p>Các phòng nghỉ sang trọng và nhiều tiện nghi, từ khu phòng hội nghị hiện đại đến nhà hàng buffet  Quốc tế  khách sạn MayStar  trở thành sự lựa chọn hoàn hảo để đi công tác hay nghỉ ngơi. MayStar Đà Nẵng cũng mang đến một thế giới
                            ẩm thực hấp dẫn để quý khách khám phá, từ những bữa ăn tự chọn theo chủ đề quốc tế quý khách sẽ được phục vụ tại nhà hàng tại tầng 3 của khách sạn.</p>
                        <p>Tọa lạc tại một vị trí đắc địa ở Đà Nẵng, khách sạn rất gần các quận trọng điểm và những điểm tham quan chính. Tôn vinh nền văn hoá giàu truyền thống của đất
                            nước này,bàn tiếp tân du lịch của khách sạn cung cấp rất nhiều lựa chọn để quý khách khám phá Việt Nam.</p>
                        <p>
                            Tất cả các phòng đều có góc ngắm cảnh tuyệt đẹp, đội ngũ nhân viên chuyên nghiệp và tiện nghi vượt trội, MayStar Đà Nẵng là nơi hoàn hảo cho bất kỳ ai muốn xua tan sự hối hả và ồn ã của thành phố để trải nghiệm những phút giây thư giãn tuyệt vời.
                            Nằm ở trung tâm với các điểm tham quan chính gần đó
                            Nội thất trang nhã với tầm nhìn tuyệt đẹp ra thành phố
                            Trang thiết bị hội nghị và hội nghị tuyệt vời
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2>Khách sạn MayStar</h2>
                </div>
            </div>
            <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/gt_1.jpg')}}" alt="images">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/gt_2.jpg')}}" alt="images">
                            </div>
                        </div>
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/gt_3.jpg')}}" height="164.89px" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="gioithieu-content">
                            <p>
                                Nằm ở trung tâm Đà Nẵng, Khách sạn quốc tế MayStar có 60 phòng. Du khách có thể
                                thưởng thức các bữa ăn tại nhà hàng trong khách sạn. Tất cả các phòng đều có mạng WiFi
                                miễn phí.
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                Đây là một lựa chọn tuyệt vời cho những chuyến công tác và cho những du khách
                                yêu thích mua sắm, ẩm thực và không gian đường phố.
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                Chúng tôi nói bằng ngôn ngữ của các bạn!
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                Khách sạn quốc tế MayStar đã đón chào các khách kể từ ngày 1/1/2019.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section-2 testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2>Tiện nghi</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="gioithieu-content">
                        <p>
                            Mỗi phòng khách tại MayStar Hotel đều được trang bị Tivi màn hình phẳng. Một số phòng được
                            thiết kế với không gian có khu vực tiếp khách thuận tiện cho quý khách. Tất cả các phòng được
                            trang bị thiết bị hiện đại, mini bar, cửa sổ hướng nhìn ra toàn cảnh của Đà Nẵng
                            Quý khách có thể liên hệ quầy lễ tân trực 24 giờ để được hỗ trợ đổi tiền, bố trí tour và dịch
                            vụ hỗ trợ đặc biệt.
                        </p>
                    </div>
                    <div class="gioithieu-content">
                        <p>
                            Quý khách có thể liên hệ quầy lễ tân trực 24 giờ để được hỗ trợ đổi tiền, bố trí tour và dịch
                            vụ hỗ trợ đặc biệt.
                        </p>
                    </div>
                    <div class="gioithieu-content">
                        <p>
                            Quý khách có thể liên hệ quầy lễ tân trực 24 giờ để được hỗ trợ đổi tiền, bố trí tour và dịch
                            vụ hỗ trợ đặc biệt.
                        </p>
                    </div>
                    <div class="gioithieu-content">
                        <p>
                            Đây cũng là vị trí thuận tiện đỗ xe 45 chỗ, cho phép tổ chức các nhóm tour có quy mô đa dạng.
                            Khách du lịch có thể cảm nhận được sự sang trọng của không gian tại đây.
                        </p>
                    </div>
                    <div>
                        <p><a href="{{route('loai-phong')}}" class="btn btn-primary">Di chuyển đến tiện nghi</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/tn_1.jpg')}}" alt="images">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/tn_2.jpg')}}" alt="images">
                            </div>
                        </div>
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/gioithieu/tn_3.jpg')}}" height="164.89px" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2>Vị trí & Liên hệ</h2>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="gioithieu">
                                    <img src="{{asset('images/gioithieu/lh.jpg')}}" alt="images">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gioithieu-content">
                            <p>
                                Vị trí thuận lợi và dễ dàng di chuyện . Tại ngay trung tâm thành phố. Mọi trở ngại
                                trở nên dễ dàng hơn
                            </p>
                            <p><a href="{{route('lien-he')}}" class="btn btn-primary">Di chuyển tới liên hệ</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
