@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.order'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          سفارشات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="" class="btn btn-info btn-sm disabled">ایجاد سفارش</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>کد سفارش</th>
                                <th>مبلغ سفارش</th>
                                <th>مبلغ تخفیف</th>
                                <th>مبلغ نهایی</th>
                                <th>وضعیت پرداخت</th>
                                <th>شیوه پرداخت</th>
                                <th>بانک</th>
                                <th>وضعیت ارسال</th>
                                <th>شیوه ارسال</th>
                                <th>وضعیت سفارش</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>5652</td>
                                <td>75.000</td>
                                <td>10.000</td>
                                <td>65.000</td>
                                <td>پرداخت شده</td>
                                <td>آنلاین</td>
                                <td>ملت</td>
                                <td>در حال ارسال</td>
                                <td>پیک موتوری</td>
                                <td>در حال ارسال</td>
                                <td class=" text-center">

                                    <div class="dropdown">
                                        <a id="dropdownMenuLink" role="button" href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" data-toggle="dropdown" arial-expanded="false">
                                            <i class="fa fa-tools"></i>
                                            عملیات
                                        </a>

                                        <div class="dropdown-menu" arial-labelledby="dropdownMenuLink">
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-images"></i> مشاهده فاکتور</a>
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-window-close"></i> باطل کردن سفارش</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
