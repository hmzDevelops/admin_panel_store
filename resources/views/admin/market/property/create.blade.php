@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.create_property'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> فرم کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فرم کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد فرم کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.property.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">نام فرم</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">فرم والد</label>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">فرم یک</option>
                                    <option value="">فرم دو</option>
                                </select>
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
