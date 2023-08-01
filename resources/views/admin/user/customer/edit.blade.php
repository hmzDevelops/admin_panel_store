@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.customer_user_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">  مشتریان </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش  مشتری </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش ادمین جدید
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.user.customer.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="firstname">نام</label>
                                <input value="{{ old('firstname', $user->firstname) }}" type="text" name="firstname"
                                    id="firstname" class="form-control form-control-sm">
                                @error('firstname')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="lastname">نام خانوادگی</label>
                                <input value="{{ old('lastname', $user->lastname) }}" type="text" name="lastname"
                                    id="lastname" class="form-control form-control-sm">
                                @error('lastname')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12  form-group">
                                <label class="font-weight-bold" for="profile_photo_path">تصویر</label>
                                <input type="file" name="profile_photo_path" id="profile_photo_path"
                                    class="form-control form-control-sm">

                                <img src="{{ asset($user->profile_photo_path) }}" alt="avatar" width="200"
                                    height="200">
                                @error('profile_photo_path')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm">ویرایش</button>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
