@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.role_create'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">  نقش ها  </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد  نقش
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-5 form-group">
                                <label class="font-weight-bold" for="">عنوان نقش</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-5 form-group">
                                <label class="font-weight-bold" for="">توضیح نقش</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                            </section>


                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check1" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check1">نمایش دسته جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check2" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check2">ایجاد دسته جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check3" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check3">ویرایش دسته جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check4" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check4">حذف دسته جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check5" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check5">نمایش کالای جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check6" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check6">ایجاد کالای جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check7" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check7">ویرایش کالای جدید</label>
                                        </div>
                                    </section>

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input form-control-sm" id="check8" checked>
                                            <label class="form-check-label font-weight-bold mr-3 mt-2" for="check8">حذف کالای جدید</label>
                                        </div>
                                    </section>


                                </section>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
