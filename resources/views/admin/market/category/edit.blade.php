@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.create_category') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش دسته بندی
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.market.category.update', $productCategory) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label for="name">نام دسته</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $productCategory->name) }}" class="form-control form-control-sm">

                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="parent_id">دسته ی والد</label>
                                <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                    <option value=""></option>
                                    @foreach ($parent_categories as $parent_categorie)
                                        <option @if ($parent_categorie->id == $productCategory->parent_id) selected @endif
                                            value="{{ $parent_categorie->id }}">{{ $parent_categorie->name }}</option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="show_in_menu">نمایش در منو</label>
                                <select name="show_in_menu" id="show_in_menu" class="form-control form-control-sm">
                                    <option value="0" @if (old('show_in_menu', $productCategory->show_in_menu) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('show_in_menu', $productCategory->show_in_menu) == 1) selected @endif>فعال</option>
                                </select>

                                @error('show_in_menu')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $productCategory->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $productCategory->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="tags">تگ ها</label>
                                <input value="{{ old('tags', $productCategory->tags) }}" type="hidden" name="tags"
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

                                    @foreach ($productCategory->image['indexArray'] as $key => $value)
                                        <section class="form-check col-md-4">

                                            <input type="radio" name="currentImage" id="{{ $number }}"
                                                value="{{ $key }}"
                                                @if ($productCategory->image['currentImage'] == $key) checked @endif>

                                            <label for="{{ $number }}">
                                                @if ($key == 'large')
                                                    بزرگ
                                                @elseif ($key == 'medium')
                                                    متوسط
                                                @else
                                                    کوچک
                                                @endif
                                                <img src="{{ asset($value) }}" alt="avatar" width="80"
                                                    height="80">
                                            </label>
                                        </section>

                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach

                                </section>

                            </section>



                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="description">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="description" id="description" cols="30" rows="6">
                                    {{ old('description', $productCategory->description) }}
                                </textarea>
                                @error('description')
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
        CKEDITOR.replace('description');
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
