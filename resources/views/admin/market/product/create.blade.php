@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.create_product') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالا </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">نام کالا</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">دسته کالا</label>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">دسته یک</option>
                                    <option value="">دسته دو</option>
                                </select>
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">فرم کالا </label>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">فرم یک</option>
                                    <option value="">فرم دو</option>
                                </select>
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">تصویر </label>
                                <input type="file" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">قیمت کالا</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">وزن</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" cols="30" rows="6"></textarea>
                            </section>

                            <section class="col-12 py-3 mb-3">
                                <div class="row">
                                    <section class="form-group col-md-3 col-6">
                                        <input type="text" name="" id=""
                                            class="form-control form-control-sm" placeholder="ویژگی...">
                                    </section>

                                    <section class="form-group col-md-3 col-6">
                                        <input type="text" name="" id=""
                                            class="form-control form-control-sm" placeholder="مقدار...">
                                    </section>

                                </div>
                                <section>
                                    <button type="button" class="btn btn-success btn-sm">افزودن</button>
                                </section>
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


@section('script')
    {{-- ckeditor loaded => root folder into public --}}
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
