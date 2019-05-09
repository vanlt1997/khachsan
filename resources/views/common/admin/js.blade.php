<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.js')}}"></script>
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
<script>
    $(document).ready(function () {
        setInterval(function () {
            this.loadData()
        }, 1000*60*2);
    });

    function loadData() {
        $.ajax({
            type: 'get',
            url: '{{route('admin.get-data')}}',
            success: function (data) {
                var html = '';
                $('.item-wait').remove();
                $('.orderWait').text(data['dataWait'].length);
                $('.orderWaitMessage').text(data['dataWait'].length + ' Notifications');
                data['dataWait'].forEach(function (order, i) {
                    url = "{{route('admin.orders.wait.edit', ':order')}}";
                    url = url.replace(':order', order.id);
                    if (i < 5) {
                        html += '<a href="'+ url +'" class="dropdown-item item-wait" ><i class="fa fa-star-o mr-2"></i>'+ order.user.name +' <span class="float-right text-muted text-sm">'+ order.date +'</span></a>'
                    }
                });
                $('#showOrderWait').append(html);
            }
        });
    }
</script>
@stack('scripts')
