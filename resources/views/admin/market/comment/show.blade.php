@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.show_comment'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نظرات </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظرها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        کامران محمدی - 8541236
                    </section>

                    <section class="card-body">
                        <h5 class="card-title">کد کالا: 8543435 - یخچال اسنوا : لوازم خانگی</h5>
                        <p class="card-text">به نظرم یخچال خوبیه فقط در سال اول قابل استفاده است</p>
                    </section>
                </section>










                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 form-group">
                                <label for="">پاسخ ادمین</label>
                                <textarea class="form-control form-control-sm" rows="4"></textarea>
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
