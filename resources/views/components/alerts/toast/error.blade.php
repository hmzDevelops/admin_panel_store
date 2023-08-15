@if(session('toast-error'))

    <section class="toast" data-delay="5000">
        <section class="toast-body py-3 d-flex bg-danger text-white">
            <strong class="ml-auto">{{ session('toast-error') }}</strong>

            <button type="button" class="mr-2 close" data-dissmiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </section>
    </section>

    @push('script')


        <script>
            $(document).ready(function() {
                $('.toast').toast('show');
            });
        </script>
    @endpush
@endif
