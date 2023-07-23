@extends('admin.layouts.master')

{{-- select2 --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">


     {{-- jalali datapicker --}}
     <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection

@section('page-title')
    <title>{{ config('constants.page_title.post_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> پست </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش پست
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.content.post.update', $post) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="name">عنوان پست</label>
                                <input value="{{ old('title', $post->title) }}" type="text" name="title"
                                    id="title" class="form-control form-control-sm">

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
                                            @if (old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}
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
                                <label class="font-weight-bold" for="image">تصویر</label>
                                <input type="file" name="image" id="image" class="form-control form-control-sm">

                                @error('image')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <section class="row">

                                    @php
                                        $number = 1;
                                    @endphp

                                    @foreach ($post->image['indexArray'] as $key => $value)
                                        <section class="form-check col-md-4">

                                            <input type="radio" name="currentImage" id="{{ $number }}" value="{{ $key }}" @if ($post->image['currentImage'] == $key)
                                            checked @endif>

                                            <label for="{{ $number }}">@if($key == "large") بزرگ @elseif ($key == "medium") متوسط @else کوچک @endif
                                                <img src="{{ old('image', asset($value)) }}" alt="avatar" width="80" height="80">
                                            </label>
                                        </section>

                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach
                                </section>
                            </section>




                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $post->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $post->status) == 1) selected @endif>فعال</option>
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
                                    <option value="0" @if ($post->commentable) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if ($post->commentable) == 1) selected @endif>فعال</option>
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
                                <input type="text" name="" id="published_at_view" class="form-control form-control-sm" value="{{ $post->published_at }}">

                                @error('published_at')
                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="tags">تگ ها</label>
                                <input value="{{ old('tags', $post->tags) }}" type="hidden" name="tags"
                                    id="tags" class="form-control form-control-sm">
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
                                    {{ old('summary', $post->summary) }}
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
                                    {{ old('body', $post->body) }}
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
        CKEDITOR.replace('summary');
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
