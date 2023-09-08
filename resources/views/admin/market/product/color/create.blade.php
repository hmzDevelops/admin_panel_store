@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.product_color_create') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد رنگ </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد رنگ
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.color.index', $product) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.market.color.store', $product) }}" method="post">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="color_name">نام رنگ</label>
                                <input value="{{ old('color_name') }}" type="text" name="color_name" id="color_name"
                                    class="form-control form-control-sm">
                                @error('color_name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="color">رنگ</label>
                                <input value="{{ old('color') }}" type="color" name="color" id="color"
                                    class="form-control form-control-sm">
                                @error('color')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>




                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="price_increase">قیمت کالا</label>
                                <input type="text" value="{{ old('price_increase') }}" name="price_increase" id="price_increase"
                                    class="form-control form-control-sm">
                                @error('price_increase')
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
