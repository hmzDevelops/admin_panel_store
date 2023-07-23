@if ($errors->any())
    <div class="alert alert-danger d-block" role="alert">

        <ul>
            <h4 class="text-center">خطایی رخ داده است</h4>
            @foreach($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
            @endforeach
        </ul>

    </div>

@endif
