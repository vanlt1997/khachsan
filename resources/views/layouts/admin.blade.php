<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="{{60*60}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    @include('common.admin.css')

    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('common.admin.header')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @yield('header')
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
        @include('common.admin.footer')
        @include('common.admin.js')
    </div>
</body>
</html>

