@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.create_delivery') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.delivery.index') }}"> روش های ارسال </a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد روش ارسال </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد روش ارسال
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.store') }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label for="">نام روش ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="name"
                                    value="{{ old('name') }}" id="name">
                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="amount">هزینه ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="amount"
                                    value="{{ old('amount') }}" id="amount">
                                @error('amount')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="delivery_time">زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="delivery_time"
                                    value="{{ old('delivery_time') }}" id="delivery_time">
                                @error('delivery_time')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="delivery_time_unit">واحد زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="delivery_time_unit"
                                    value="{{ old('delivery_time_unit') }}" id="delivery_time_unit">
                                @error('delivery_time_unit')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
