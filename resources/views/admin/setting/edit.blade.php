@extends('admin.layouts.master')

{{-- select2 --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.setting_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> تنظیمات </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تنظیمات
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.setting.update', $setting) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <section class="row">
                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="name">عنوان سایت</label>
                                <input value="{{ old('name', $setting->title) }}" type="text" name="title"
                                    id="title" class="form-control form-control-sm">

                                @error('title')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="tags">کلمات کلیدی سایت</label>
                                <input value="{{ old('keywords', $setting->keywords) }}" type="hidden" name="keywords"
                                    id="keywords" class="form-control form-control-sm">
                                <select class="select2 form-control form-control-sm" name="" id="select_tags"
                                    multiple>

                                </select>

                                @error('keywords')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="description">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="description" id="description" cols="30" rows="6">
                                    {{ old('description', $setting->description) }}
                                </textarea>

                                @error('description')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="logo">لوگو</label>
                                <input type="file" name="logo" id="logo" class="form-control form-control-sm">

                                @error('logo')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="icon">آیکون</label>
                                <input type="file" name="icon" id="icon" class="form-control form-control-sm">

                                @error('icon')
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

@section('script')

    {{-- select2 --}}
    <script src="{{ asset('script/components/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var tags_input = $("#keywords");
            var select_tags = $("#select_tags");
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() != null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ مورد نظر را انتخاب کنید',
                tags: 'true',
                data: default_data,
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $("#form").submit(function(event) {
                if (select_tags.val() != null && select_tags.length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource);
                }
            });
        });
    </script>
@endsection
