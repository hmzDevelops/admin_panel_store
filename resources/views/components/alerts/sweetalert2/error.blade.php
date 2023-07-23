@if(session('swal-error'))

@section('script')
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.all.min.js') }}"></script>
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            Swal.fire({
                title: 'خطا',
                text: '{{ session('swal-error') }}',
                icon: 'error',
                confirmButtonText: 'باشه',
            });
        });
    </script>
@endsection


@endif
