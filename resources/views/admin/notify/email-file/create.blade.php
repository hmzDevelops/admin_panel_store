@extends('admin.layouts.master')


@section('style')
    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.email_file_create') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاعیه ایمیلی </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فایل </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد فایل اطلاعیه ایمیلی
                    </h5>
                </section>

                @include('errors.form_error')


                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.notify.email-file.index', $email->id) }}"
                        class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.notify.email-file.store', $email->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="file">فایل</label>
                                <input type="file" name="file" id="file" class="form-control form-control-sm">

                                @error('file')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12  form-group">
                                <label class="font-weight-bold" for="file_location">محل ذخیره سازی</label>
                                <select name="file_location" id="file_location" class="form-control form-control-sm">
                                    <option value="1" selected >ذخیره در Public</option>
                                    <option value="2" >ذخیره در Storage</option>
                                </select>
                            </section>

                            <section class="col-12  form-group">
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
