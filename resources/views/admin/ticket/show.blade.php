@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.ticket_show') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> تیکت ها </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش تیکت ها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش تیکت ها
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.ticket.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $ticket->user->fullName }} - {{ $ticket->id }}
                    </section>

                    <section class="card-body">
                        <h6 class="d-inline card-title">موضوع تیکت :</h6>
                        <h2 class="d-inline">{{ $ticket->subject }} </h2>
                        <br>
                        <p class="card-text text-info font-weight-bold">{{ $ticket->description }}</p>
                    </section>
                </section>


                @if ($ticket->status == 1 )
                    <section>

                        <form action="{{ route('admin.ticket.answer', $ticket) }}" method="post">
                            @csrf

                            <section class="row">

                                <section class="col-12 form-group">
                                    <label for="">پاسخ ادمین</label>
                                    <textarea class="form-control form-control-sm" rows="4" name="description">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </section>


                                <input type="hidden" value="1" name="seen">

                                <section class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>


                        </form>

                    </section>
                @endif



            </section>
        </section>
    </section>
@endsection
