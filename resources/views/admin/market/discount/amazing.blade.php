@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.sale_amazing'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فروش شگفت انگیز  </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                           فروش شگفت انگیز
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.discount.amazingSaleCreate') }}" class="btn btn-info btn-sm">افزودن کالا به لیست شگفت انگیز</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کالا</th>
                                <th>درصد تخفیف</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th class="max-width-16-rem text-center "><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>تلویزیون</td>
                                <td>30%</td>
                                <td>اردیبهشت 99</td>
                                <td>تیر 99</td>
                                <td class="width-16-rem text-center">
                                    <a href="#" class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> نمایش</a>
                                    <button class="btn btn-danger btn-sm w-6" type="submit"><i class="fa fa-trash-alt"></i>
                                        تائید</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
