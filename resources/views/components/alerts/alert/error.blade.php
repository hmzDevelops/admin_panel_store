@if(session('alert-error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <h4 class="alert-heading">خطا </h4>
    <hr>

    <p class="mb-0">
        {{ session('alert-danger') }}
    </p>

    <button class="close" type="button" data-dissmiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif
