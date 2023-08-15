@extends('admin.layouts.master')


@section('page-title')
    <title>{{ config('constants.page_title.product_gallery_create') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد تصویر </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد تصویر
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.gallery.index', $product) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.market.gallery.store', $product) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <section class="row">


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="image">اتتخاب تصویر </label>
                                <input type="file" name="image" class="form-control form-control-sm">
                                @error('image')
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
