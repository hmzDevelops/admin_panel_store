@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.post_create'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> پست </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پست ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد پست
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="" method="">
                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label for="">عنوان پست</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="">انتخاب دسته</label>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">آموزشی</option>
                                    <option value="">سرگرمی</option>
                                </select>
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="">انتخاب تصویر</label>
                                <input type="file" name="" id="" class="form-control form-control-sm">
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="">متن پست</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" cols="30" rows="6"></textarea>
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

@section('script')
    {{-- ckeditor loaded => root folder into public --}}
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
