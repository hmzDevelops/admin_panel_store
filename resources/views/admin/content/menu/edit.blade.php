@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.menu_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش منو
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.content.menu.update', $menu) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-6 form-group">
                                <label class="font-weight-bold" for="name">نام منو</label>
                                <input value="{{ old('name', $menu->name) }}" type="text" name="name" id="name"
                                    class="form-control form-control-sm">
                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="parent_id">منوی والد</label>
                                <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                    <option value="">منوی اصلی</option>
                                    @foreach ($parent_menus as $parent_menu)
                                            <option value="{{ $parent_menu->id }}"
                                                @if (old('parent_id', $menu->parent_id) == $parent_menu->id) selected @endif>{{ $parent_menu->name }}</option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-6 form-group">
                                <label class="font-weight-bold" for="url">آدرس url</label>
                                <input value="{{ old('url', $menu->url) }}" type="text" name="url" id="url"
                                    class="form-control form-control-sm">
                                @error('url')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $menu->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $menu->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
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
