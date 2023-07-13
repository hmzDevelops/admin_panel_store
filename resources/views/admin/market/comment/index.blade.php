@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.comment'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر</a>
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
                                <th class="col-md-1">کد کاربر</th>
                                <th class="col-md-2">نویسنده نظر</th>
                                <th class="col-md-1">کد کالا</th>
                                <th class="col-md-2">کالا</th>
                                <th class="col-md-2">وضعیت</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>85412</td>
                                <td>زهرا حمیدی</td>
                                <td>98526521</td>
                                <td>یخچال اسنوا</td>
                                <td>در انتظار تائید</td>
                                <td class="width-16-rem text-center">
                                    <a href="{{ route('admin.market.comment.show') }}" class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> نمایش</a>
                                    <button class="btn btn-success btn-sm w-6" type="submit"><i class="fa fa-check"></i>
                                        تائید</button>
                                </td>
                            </tr>

                            <tr>
                                <th>1</th>
                                <td>85412</td>
                                <td>زهرا حمیدی</td>
                                <td>98526521</td>
                                <td>یخچال اسنوا</td>
                                <td>تائدی شده</td>
                                <td class="width-16-rem text-center">
                                    <a href="{{ route('admin.market.comment.show') }}" class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> نمایش</a>
                                    <button class="btn btn-warning btn-sm w-6" type="submit"><i class="fa fa-clock"></i>
                                        عدم تائید</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
