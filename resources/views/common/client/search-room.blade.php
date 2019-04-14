<div class="col-md-12 amenities d-md-flex ftco-animate mb-5">
    <div style="width: 100%; background-color: #fff">
        <h5 class="text-primary text-center mt-5">Check room of {{$typeRoom->name}}</h5>
        <form method="post" class="col-md-12 row">
            @csrf
            <input type="number" name="typeRoom" class="form-control" value="{{$typeRoom->id}}" hidden>
            <div class="form-group row col-md-12 ">
                <div class="col-md-4 mt-4">
                    <label for="startDate">Checkin</label>
                    <input type="date" name="startDate" class="form-control" value="{{old('startDate')}}">
                    @if($errors->has('startDate'))
                        <p class="text-danger"><i
                                    class="fa fa-exclamation-circle"></i> {{$errors->first('startDate')}}</p>
                    @endif
                </div>
                <div class="col-md-4 mt-4">
                    <label for="endDate">Checkout</label>
                    <input type="date" name="endDate" class="form-control" value="{{old('endDate')}}">
                    @if($errors->has('endDate'))
                        <p class="text-danger"><i
                                    class="fa fa-exclamation-circle"></i> {{$errors->first('endDate')}}</p>
                    @endif
                </div>
                <div class="col-md-3 mt-4">
                    <label for="number_people">People</label>
                    <input type="number" name="number_people" class="form-control" placeholder="Number" value="{{old('number_people')}}">
                    @if($errors->has('number_people'))
                        <p class="text-danger"><i
                                    class="fa fa-exclamation-circle"></i> {{$errors->first('number_people')}}</p>
                    @endif
                </div>
                <div class="col-md-1 text-right mt-4">
                    <button type="submit" class="btn btn-sm btn-outline-primary" style="margin-top: 45px;">Check room</button>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="text-center">
                    @if(Session::has('error'))
                        <h5 class="text-danger">{{Session::get('error')}}</h5>
                    @endif
                    @if(Session::has('message'))
                        <h5 class="text-danger">{{Session::get('message')}}</h5>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

