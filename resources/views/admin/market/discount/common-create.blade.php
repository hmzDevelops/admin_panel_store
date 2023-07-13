@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.create_public_discount'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">  ایجاد کوپن عمومی  </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کوپن عمومی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label for="" class="font-weight-bold">درصد تخفیف</label>
                                <input type="text" class="form-control form-control-sm">
                            </section>


                            <section class="col-12 col-md-4 form-group">
                                <label for="" class="font-weight-bold">حداکثر تخفیف</label>
                                <input type="text" class="form-control form-control-sm">
                            </section>


                            <section class="col-12 col-md-4 form-group">
                                <label for="" class="font-weight-bold">عنوان مناسبت</label>
                                <input type="text" class="form-control form-control-sm">
                            </section>


                            <section class="col-12 col-md-4 form-group">
                                <label for="" class="font-weight-bold">تاریخ شروع</label>
                                <input type="text" class="form-control form-control-sm">
                            </section>


                            <section class="col-12 col-md-4 form-group">
                                <label for="" class="font-weight-bold">تاریخ پایان</label>
                                <input type="text" class="form-control form-control-sm">
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
