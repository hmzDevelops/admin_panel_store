@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.admin_user_create'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">  کاربران ادمین </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد ادمین جدید
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">نام</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">نام خانوادگی</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">ایمیل</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">موبایل</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">کلمه عبور</label>
                                <input type="password" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">تکرار کلمه عبور</label>
                                <input type="password" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">تصویر</label>
                                <input type="file" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">وضعیت کاربر</label>
                                <select class="form-control form-control-sm" name="" id="">
                                    <option value="">فعال</option>
                                    <option value="">غیر فعال</option>
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
