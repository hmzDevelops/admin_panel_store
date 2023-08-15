@extends('admin.layouts.master')

@section('style')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('style/components/select2/select2.min.css') }}">

    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.create_product') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالا </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کالا
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form id="form" action="{{ route('admin.market.product.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="name">نام کالا</label>
                                <input value="{{ old('name') }}" type="text" name="name" id="name"
                                    class="form-control form-control-sm">
                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="image">تصویر </label>
                                <input type="file" name="image" class="form-control form-control-sm">
                                @error('image')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="price">قیمت کالا</label>
                                <input type="text" value="{{ old('price') }}" name="price" id="price"
                                    class="form-control form-control-sm">
                                @error('price')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="weight">وزن</label>
                                <input type="text" value="{{ old('weight') }}" name="weight" id="weight"
                                    class="form-control form-control-sm">
                                @error('weight')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="length">طول</label>
                                <input type="text" value="{{ old('length') }}" name="length" id="length"
                                    class="form-control form-control-sm">
                                @error('length')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="width">عرض</label>
                                <input type="text" value="{{ old('width') }}" name="width" id="width"
                                    class="form-control form-control-sm">
                                @error('width')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="height">ارتفاع</label>
                                <input type="text" value="{{ old('height') }}" name="height" id="height"
                                    class="form-control form-control-sm">
                                @error('height')
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
                                <label class="font-weight-bold" for="marketable">قابل فروش بودن</label>
                                <select name="marketable" id="marketable" class="form-control form-control-sm">
                                    <option value="0" @if (old('marketable') == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('marketable') == 1) selected @endif>فعال</option>
                                </select>

                                @error('marketable')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
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

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="category_id">انتخاب دسته</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm">
                                    @foreach ($productCategories as $productCategory)
                                        <option value="{{ $productCategory->id }}"
                                            @if (old('category_id') == $productCategory->id) selected @endif>{{ $productCategory->name }}
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
                                <label class="font-weight-bold" for="brand_id">انتخاب برند</label>
                                <select name="brand_id" id="brand_id" class="form-control form-control-sm">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if (old('brand_id') == $brand->id) selected @endif>{{ $brand->orginal_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="published_at">تاریخ انتشار</label>


                                <input type="text" name="published_at" id="published_at"
                                    class="d-none form-control form-control-sm">
                                <input type="text" name="" id="published_at_view"
                                    class="form-control form-control-sm">
                                @error('published_at')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="introduction">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="introduction" id="introduction" cols="30" rows="6"></textarea>
                                @error('introduction')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>



                            <section class="col-12 py-3 mb-3">
                                <div class="row">
                                    <section class="form-group col-md-3 col-6">
                                        <input type="text" name="meta_key[]" class="form-control form-control-sm"
                                            placeholder="ویژگی...">
                                        @error('meta_key.*')
                                            <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="form-group col-md-3 col-6">
                                        <input type="text" name="meta_value[]" class="form-control form-control-sm"
                                            placeholder="مقدار...">
                                        @error('meta_value.*')
                                            <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </section>

                                </div>
                                <section>
                                    <button id="btnCopy" type="button" class="btn btn-success btn-sm">افزودن</button>
                                </section>
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
        CKEDITOR.replace('introduction');
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
        $(document).ready(function() {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
            });
        });
    </script>


    <script>
        $(function() {

            $('#btnCopy').on('click', function() {
                var eleman = $(this).parent().prev().clone(true);
                $(this).before(eleman);
            });

        });
    </script>
@endsection
