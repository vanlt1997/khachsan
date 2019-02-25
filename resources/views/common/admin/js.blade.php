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
