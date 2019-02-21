<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('common.client.css')
</head>
<body>

@include('common.client.header')
@yield('slidebar')
@yield('content')

@include('common.client.footer')

@include('common.client.js')

</body>
</html>
