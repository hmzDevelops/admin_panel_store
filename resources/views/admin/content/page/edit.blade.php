@extends('admin.layouts.master')

@section('style')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.page_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش صفحات</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> صفحات </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش صفحه</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش صفحه
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.page.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.content.page.update', $page) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="title">عنوان پیج</label>
                                <input value="{{ old('title', $page->title) }}" type="text" name="title" id="title"
                                    class="form-control form-control-sm">
                                @error('title')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $page->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $page->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="tags">تگ ها</label>
                                <input value="{{ old('tags', $page->tags) }}" type="hidden" name="tags" id="tags"
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
                                <label class="font-weight-bold" for="body">محتوا</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" cols="30" rows="6">
                                    {{ old('body', $page->body) }}
                                </textarea>
                                @error('body')
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
    {{-- ckeditor loaded => root folder into public --}}
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
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
