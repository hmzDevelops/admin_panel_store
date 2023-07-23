@extends('admin.layouts.master')

@section('style')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">

    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.post_create') }}</title>
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

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.content.post.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="title">عنوان پست</label>
                                <input value="{{ old('title') }}" type="text" name="title" id="title"
                                    class="form-control form-control-sm">

                                @error('title')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="category_id">انتخاب دسته</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm">
                                    @foreach ($postCategorys as $postCategory)
                                        <option value="{{ $postCategory->id }}"
                                            @if (old('category_id') == $postCategory->id) selected @endif>{{ $postCategory->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
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
                                <label class="font-weight-bold" for="commentable">امکان درج کامنت</label>
                                <select name="commentable" id="commentable" class="form-control form-control-sm">
                                    <option value="0" @if (old('commentable') == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('commentable') == 1) selected @endif>فعال</option>
                                </select>

                                @error('commentable')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="">تاریخ انتشار</label>
                                <input type="text" name="published_at" id="published_at" class="d-none form-control form-control-sm">
                                <input type="text" name="" id="published_at_view" class="form-control form-control-sm">

                                @error('published_at')
                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="tags">تگ ها</label>
                                <input value="{{ old('tags') }}" type="hidden" name="tags" id="tags"
                                    class="form-control form-control-sm">
                                <select class="select2 form-control form-control-sm" name="" id="select_tags"
                                    multiple>

                                </select>

                                @error('tags')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="summery">خلاصه پست</label>
                                <textarea class="form-control form-control-sm" name="summary" id="summary" cols="30" rows="6">
                                    {{ old('summary') }}
                                </textarea>

                                @error('summary')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="">متن پست</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" cols="30" rows="6">
                                    {{ old('body') }}
                                </textarea>

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
        CKEDITOR.replace('summary');
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


    {{-- jalali datepicker --}}
    <script src="{{ asset('script/components/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('script/components/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField:'#published_at',
            });
        });
    </script>
@endsection
