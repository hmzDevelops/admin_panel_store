@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.create_property') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> فرم کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقدار فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد مقدار فرم کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.value.index', $category_attribute) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.market.value.store', $category_attribute) }}" method="post">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6  form-group">
                                <label class="font-weight-bold" for="product_id">انتخاب محصول</label>
                                <select name="product_id" id="product_id" class="form-control form-control-sm">
                                    @foreach ($category_attribute->category->products as $product)
                                        <option value="{{ $product->id }}"
                                            @if (old('product_id') == $product->id) selected @endif>{{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="type">نوع</label>
                                <select name="type" id="type" class="form-control form-control-sm">
                                    <option value="0" @if (old('type') == 0) selected @endif>ساده
                                    </option>
                                    <option value="1" @if (old('type') == 1) selected @endif>انتخابی</option>
                                </select>

                                @error('type')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="value">مقدار</label>
                                <input type="text" name="value" value="{{ old('value') }}"
                                    class="form-control form-control-sm">
                                @error('value')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="value">افزایش قیمت</label>
                                <input type="text" name="price_increase" value="{{ old('price_increase') }}"
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
