<script src="{{ asset('admin-assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/popper.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/grid.js') }}"></script>


{{-- بروزرسانی جدول دیتابیس پس از مشاهده ناتفیکیشن --}}
<script>
    $("#header-notification-toggle").click(function() {
        $.ajax({
            type: 'post',
            url: '/admin/notification/read-all ',
            data:{
                _token: '{{ @csrf_token() }}'
            },
            success: function(){

            }
        });
    });
</script>
