@if(session('alert-success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">

    <h4 class="alert-heading">تبریک </h4>
    <hr>

    <p class="mb-0">
        {{ session('alert-success') }}
    </p>

    <button class="close" type="button" data-dissmiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif
