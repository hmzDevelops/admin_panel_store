
@if (session('swal-success'))
    @push('ajax')
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'عملیات با موفقیت انجام شد',
                    text: '{{ session('swal-success') }}',
                    icon: 'success',
                    confirmButtonText: 'باشه',
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                       
                    }
                });
            });
        </script>
    @endpush
@endif
