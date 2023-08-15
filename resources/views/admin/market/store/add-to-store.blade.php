@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.add_store') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> انبار </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن به انبار </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اضافه کردن به انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.market.store.store', $product) }}" method="post">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="reciver">نام تحویل گیرنده</label>
                                <input type="text" name="reciver" value="{{ old('reciver') }}"
                                    class="form-control form-control-sm">
                                @error('reciver')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="deliver">نام تحویل دهنده</label>
                                <input type="text" name="deliver" value="{{ old('deliver') }}"
                                    class="form-control form-control-sm">
                                @error('deliver')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="marketable_number">تعداد</label>
                                <input type="text" name="marketable_number" value="{{ old('marketable_number') }}"
                                    class="form-control form-control-sm">
                                @error('marketable_number')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="description">توضیحات</label>
                                <textarea name="description" rows="4" class="form-control form-control-sm">{{ old('description') }}</textarea>
                                @error('description')
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
