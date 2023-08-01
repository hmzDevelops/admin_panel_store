@extends('admin.layouts.master')


@section('style')
    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.email_create'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاعیه ایمیلی </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد ایمیل </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد اطلاعیه ایمیلی
                    </h5>
                </section>

                @include('errors.form_error')


                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.notify.email.store') }}" method="post">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="subject">عنوان ایمیل</label>
                                <input value="{{ old('subject') }}" type="text" name="subject" id="" class="form-control form-control-sm">

                                @error('subject')
                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">تاریخ انتشار</label>
                                <input value="{{ old('published_at') }}" type="text" name="published_at"
                                    id="published_at" class="d-none form-control form-control-sm">
                                <input type="text" name="" id="published_at_view"
                                    class="form-control form-control-sm">

                                @error('published_at')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status') == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="">متن ایمیل</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" cols="30" rows="6"></textarea>

                                @error('body')
                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

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

    {{-- jalali datepicker --}}
<script src="{{ asset('script/components/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('script/components/jalalidatepicker/persian-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#published_at_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#published_at',
            timePicker: {
                enabled: true,
                merdiem: {
                    enabled: true
                }
            }
        });
    });
</script>
@endsection

