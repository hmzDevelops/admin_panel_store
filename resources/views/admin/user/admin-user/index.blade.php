@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.admin_user_index'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین  </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                           کاربران ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>
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
                                <th class="col-md-2">ایمیل</th>
                                <th class="col-md-1">موبایل</th>
                                <th class="col-md-2">نام</th>
                                <th class="col-md-2">نام خانوادگی</th>
                                <th class="col-md-1">نقش</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>mirzaeian2012@gmail.com</td>
                                <td>09393173412</td>
                                <td>حمزه</td>
                                <td>میرزائیان</td>
                                <td>سوپر ادمین</td>
                                <td class="width-16-rem text-center">
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>نقش</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i>
                                        حذف</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
