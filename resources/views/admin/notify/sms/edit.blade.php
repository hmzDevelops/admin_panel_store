@extends('admin.layouts.master')

@section('style')
    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.sms_create') }}</title>
    <title>{{ config('constants.page_title.sms_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاعیه پیامکی </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پیامک </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش  پیامکی
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.notify.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>


                <section>

                    <form action="{{ route('admin.notify.sms.update', $sms) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="title">عنوان پیامک</label>
                                <input value="{{ old('title', $sms->title) }}" type="text" name="title" id="title"
                                    class="form-control form-control-sm">
                                @error('title')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="">تاریخ انتشار</label>
                                <input value="{{ old('published_at', $sms->published_at) }}" type="text" name="published_at"
                                    id="published_at" class="d-none form-control form-control-sm" value="{{ $sms->published_at }}">
                                <input type="text" name="" id="published_at_view"
                                    class="form-control form-control-sm" value="{{ $sms->published_at }}">

                                @error('published_at')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 col-md-4 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $sms->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $sms->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="">متن پیامک</label>
                                <textarea name="body" id="" cols="30" rows="5" class="form-control form-control-sm">{{ old('body', $sms->body) }}</textarea>
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
    @endsection

    @section('script')
        {{-- jalali datepicker --}}
        <script src="{{ asset('script/components/jalalidatepicker/persian-date.min.js') }}"></script>
        <script src="{{ asset('script/components/jalalidatepicker/persian-datepicker.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#published_at_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#published_at',
                    timePicker: {
                        enabled: true,
                        merdiem: {
                            enabled: true
                        }
                    }
                });
            });
        </script>
    @endsection
