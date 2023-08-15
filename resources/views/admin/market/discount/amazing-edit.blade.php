@extends('admin.layouts.master')

@section('style')
    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.create_amazing_discount') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش فروش شگفت انگیز </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش فروش شگفت انگیز
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.discount.amazingSale') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.amazingSale.update', $amazingSale) }}" method="post">
                        @csrf
                        @method('put')
                        
                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="product_id">انتخاب کالا</label>
                                <select name="product_id" class="form-control form-control-sm">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            @if (old('category_id', $amazingSale->product_id) == $product->id) selected @endif>{{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label for="percentage" class="font-weight-bold">درصد تخفیف</label>
                                <input type="text" class="form-control form-control-sm" name="percentage"
                                    value="{{ old('percentage', $amazingSale->percentage) }}">
                                @error('percentage')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $amazingSale->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $amazingSale->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="start_date">تاریخ شروع</label>
                                <input type="text" name="start_date" id="start_date"
                                    class="d-none form-control form-control-sm">
                                <input type="text" id="start_date_view" class="form-control form-control-sm"
                                    value="{{ old('start_date', $amazingSale->start_date) }}">

                                @error('start_date')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="end_date">تاریخ پایان</label>
                                <input type="text" name="end_date" id="end_date"
                                    class="d-none form-control form-control-sm">
                                <input type="text" id="end_date_view" class="form-control form-control-sm"
                                    value="{{ old('end_date', $amazingSale->end_date) }}">

                                @error('end_date')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm">ویرایش</button>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection


@section('script')
    {{-- jalali datepicker --}}
    <script src="{{ asset('script/components/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('script/components/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date',
            }), $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date',
            });
        });
    </script>
@endsection
