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

                    <form action="{{ route('admin.market.store.update', $product) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="marketable_number">تعداد قابل فروش</label>
                                <input type="text" name="marketable_number" value="{{ old('marketable_number', $product->marketable_number) }}"
                                    class="form-control form-control-sm">
                                @error('marketable_number')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="sold_number">تعداد فروخته شده</label>
                                <input type="text" name="sold_number" value="{{ old('sold_number', $product->sold_number) }}"
                                    class="form-control form-control-sm">
                                @error('sold_number')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="frozen_number">رزرو شده</label>
                                <input type="text" name="frozen_number"
                                    value="{{ old('frozen_number', $product->frozen_number) }}"
                                    class="form-control form-control-sm">
                                @error('frozen_number')
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
