@if(session('alert-warning'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">

    <h4 class="alert-heading">اخطار </h4>
    <hr>

    <p class="mb-0">
        {{ session('alert-warning') }}
    </p>

    <button class="close" type="button" data-dissmiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif
