@if(session('alert-info'))

<div class="alert alert-info alert-dismissible fade show" role="alert">

    <h4 class="alert-heading">توجه </h4>
    <hr>

    <p class="mb-0">
        {{ session('alert-info') }}
    </p>

    <button class="close" type="button" data-dissmiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif
