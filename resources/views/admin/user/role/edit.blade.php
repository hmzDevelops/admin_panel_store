@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.role_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نقش ها </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش نقش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش نقش
                    </h5>
                </section>

                @include('errors.form_error')


                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.user.role.update', $role) }}" method="post">
                        @csrf
                        @method('put')
                        
                        <section class="row">

                            <section class="col-12 col-md-5 form-group">
                                <label class="font-weight-bold" for="name">عنوان نقش</label>
                                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                                    class="form-control form-control-sm">
                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-5 form-group">
                                <label class="font-weight-bold" for="description">توضیح نقش</label>
                                <input type="text" name="description" value="{{ old('description', $role->description) }}"
                                    class="form-control form-control-sm">
                                @error('description')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                            </section>


                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">



                                </section>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
