<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="text-danger">Hotel MayStar</h3>
    </div>
    <div class="col-md-12 text-center">
        <h3 class="text-danger">List Devices In Hotel</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table border="1" cellspacing="0" cellpadding="15px" width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            @foreach($devices as $device)
                <tr>
                    <td>{{$device->id}}</td>
                    <td>{{$device->name}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
