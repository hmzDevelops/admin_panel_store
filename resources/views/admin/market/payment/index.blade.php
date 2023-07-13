@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.payment'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          پرداخت ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="#" class="btn btn-info btn-sm disabled">پرداخت جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-2">کد تراکنش</th>
                                <th class="col-md-1">بانک</th>
                                <th class="col-md-2">پرداخت کننده</th>
                                <th class="col-md-2">وضعیت پرداخت</th>
                                <th class="col-md-1">نوع پرداخت</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>6421</td>
                                <td>ملت</td>
                                <td>رضا اسدی</td>
                                <td>تائید شده</td>
                                <td>آنلاین</td>
                                <td class="width-16-rem text-center">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-ban"></i> باطل کردن</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> برگرداندن</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
