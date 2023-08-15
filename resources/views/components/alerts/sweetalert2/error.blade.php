@if (session('swal-error'))
    @push('ajax')
       
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'خطا',
                    text: '{{ session('swal-error') }}',
                    icon: 'error',
                    confirmButtonText: 'باشه',
                });
            });
        </script>
    @endpush
@endif
