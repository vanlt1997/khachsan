<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('plugins/bower/datatables/media/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

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

</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
<script src="{{ asset('plugins/bower/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bower/datatables/media/js/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('plugins/bower/datatables/media/js/dataTables.bootstrap4.min.js') }}" ></script>
<script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector :'textarea#editor',
        theme: 'modern',
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor imagetools'
        ],
        height:300,
        content_css: 'css/content.css',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'

    })
</script>
@stack('scripts')
</body>
</html>
