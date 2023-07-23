@extends('admin.layouts.master')

@section('style')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.faq_create'); }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد  سوال</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد سوال
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.content.faq.store') }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="question">پرسش</label>
                                <input class="form-control form-control-sm" type="text" name="question" id="question" value="{{ old('question') }}">
                                @error('question')
                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                                <label class="font-weight-bold" for="tags">تگ ها</label>
                                <input value="{{ old('tags') }}" type="hidden" name="tags" id="tags"
                                    class="form-control form-control-sm">
                                <select class="select2 form-control form-control-sm" name="tags" id="select_tags"
                                    multiple>

                                </select>

                                @error('tags')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="answer">پاسخ</label>
                                <textarea class="form-control form-control-sm" name="answer" id="answer" cols="30" rows="6">{{ old('answer') }}</textarea>
                                @error('answer')
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
        CKEDITOR.replace('answer');
    </script>


    {{-- select2 --}}
    <script src="{{ asset('script/components/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var tags_input = $("#tags");
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
