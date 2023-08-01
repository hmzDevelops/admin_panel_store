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

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="firstname">نام</label>
                                <input value="{{ old('firstname') }}" type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                                @error('firstname')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="lastname">نام خانوادگی</label>
                                <input value="{{ old('lastname') }}" type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                                @error('lastname')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="email">ایمیل</label>
                                <input value="{{ old('email') }}" type="text" name="email" id="email" class="form-control form-control-sm">
                                @error('email')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="mobile">موبایل</label>
                                <input value="{{ old('mobile') }}" type="text" name="mobile" id="mobile" class="form-control form-control-sm">
                                @error('mobile')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="password">کلمه عبور</label>
                                <input value="{{ old('password') }}" type="password" name="password" id="password" class="form-control form-control-sm">
                                @error('password')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="password_confirmation">تکرار کلمه عبور</label>
                                <input value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm">
                                @error('password_confirmation')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="profile_photo_path">تصویر</label>
                                <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control form-control-sm">
                                @error('profile_photo_path')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="status">وضعیت فعالسازی</label>
                                <select name="activation" id="activation" class="form-control form-control-sm">
                                    <option value="0" @if (old('activation') == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('activation') == 1) selected @endif>فعال</option>
                                </select>

                                @error('activation')
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
