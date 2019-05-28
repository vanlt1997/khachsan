<figure>
    <h3>Welcome {{$contact->name}} to Hotel MayStar</h3>
    <h4>Congratulations on becoming one of our customers who can receive our special offers. Quickly book a room to receive it.</h4>

    <h4>Introduce Hotel</h4>
    <p>
        Located in a beautiful location in the heart of Da Nang, Vietnam, Danang MayStar Hotel welcomes all guests looking
        for a luxurious base with top amenities and the most attentive service at Vietnam.
    </p>
    <p>
        All rooms have beautiful views, excellent staff and outstanding facilities, MayStar Danang is the perfect place for
        anyone who wants to dispel the hustle and bustle of the city to experience the moments of the letter. great relaxation.
        Located in the center with nearby main attractions Elegant interior with beautiful cityscape Great conference and
        conference equipment
    </p>

    <h4>Infomation Rooms</h4>
    <p>
        Each guest room at MayStar Hotel is equipped with a flat-screen TV. Some rooms are okay Designed with space for
        a seating area for your convenience. All rooms are Equipped with modern equipment, mini bar, windows with panoramic
        views of Danang Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation Special support.
    </p>
    <p>
        Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation Special support.
    </p>
    <p>
        Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation Special support.
    </p>
    <p>
        This is also a convenient location for 45-seater parking, allowing the organization of tour groups with different
        scales. Tourists can feel the luxury of space here.
    </p>

    <h4>Infomtion Promotions</h4>
    <table class="table table-bordered" border="1" cellspacing="0" cellpadding="15px">
        <thead>
            <tr>
                <th>Title</th>
                <th>Sale (%)</th>
                <th>Content</th>
                <th>Code</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{$promotion['title']}}</td>
                    <td>{{$promotion['sale']}}</td>
                    <td>{!! $promotion['description'] !!}</td>
                    <td>{{$promotion['code']}}</td>
                    <td>{{$promotion['startDate']}}</td>
                    <td>{{$promotion['endDate']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <h4>Please contact</h4>
    <p class="text-primary">Email: maystarhotel@gmail.com</p>
    <p class="text-primary">Hotline : 0335833102</p>
    <p class="text-primary">Address: Hotel MayStar, Da Nang</p>
    <p class="text-primary">Website: <a href="http://quanlykhachsanmaystar.herokuapp.com">quanlykhachsanmaystar.herokuapp.com</a> </p>
</figure>
