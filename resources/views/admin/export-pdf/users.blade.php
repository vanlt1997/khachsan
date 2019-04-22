<div class="col-md-12">
    <h3>Hotel MayStar</h3>
</div>
<div class="col-md-12">
    <h4>List Users</h4>
</div>
<table border="1" cellspacing="0" cellpadding="15px" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Sex</th>
        <th>Address</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->sex}}</td>
            <td>{{$user->address}}</td>
        </tr>
    @endforeach
</table>

