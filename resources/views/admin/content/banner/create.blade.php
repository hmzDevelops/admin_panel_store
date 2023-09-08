@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.post_create') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بنر </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد بنر ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد بنر
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.content.banner.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="title">عنوان بنر</label>
                                <input value="{{ old('title') }}" type="text" name="title" id="title"
                                    class="form-control form-control-sm">

                                @error('title')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="image">انتخاب تصویر</label>
                                <input type="file" name="image" id="image" class="form-control form-control-sm">
                            </section>

                            <section class="col-12 col-md-6 form-group">
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


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="url">آدرس URL</label>
                                <input value="{{ old('url') }}" type="text" name="url" id="url"
                                    class="form-control form-control-sm">

                                @error('url')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="position">موقعیت</label>

                                <select name="position" id="position" class="form-control form-control-sm">

                                    @foreach ($positions as $position)
                                        <option value="{{ $loop->iteration - 1 }}"
                                            @if (old('position') == $loop->iteration) selected @endif>{{ $position }}</option>
                                    @endforeach


                                </select>

                                @error('position')
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
