
<section class="instagram">
    <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2><span class="icon-instagram"></span> Images</h2>
            </div>
        </div>
        <div class="row no-gutters">
            @foreach($images as $image)
                <div class="col-sm-12 col-md-2 ftco-animate">
                    <a href="{{asset("images/admin/library-images/$image->url")}}" class="insta-img image-popup" style="background-image: url({{asset("images/admin/library-images/$image->url")}});background-position: center;">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">MayStar</h2>
                    <p>Behind the mountains, far away, near the beach. Welcome <a href="{{route('client.index')}}">MyStar</a> to relax and enjoy the comfortable, wonderful moments ...</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Open</h2>
                    <ul class="list-unstyled">
                        <li><a class="py-2 d-block">Monday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Tuesday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Wednesday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Thursday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Friday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Saturday: <span>08:00 - 22:00</span></a></li>
                        <li><a class="py-2 d-block">Sunday: <span>08:00 - 22:00</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Infomation contact</h2>
                    <ul class="list-unstyled">
                        <li><a class="py-2 d-block">Đà Nẵng</a></li>
                        <li><a class="py-2 d-block">0335833102</a></li>
                        <li><a class="py-2 d-block">maystar@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> By Lê Thị Vân - CNTT3 - K56 - MSV: 151202806</p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
