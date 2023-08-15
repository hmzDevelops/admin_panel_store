@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.setting_index') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        لیست کلیه جدولهای بانک اطلاعاتی
                    </h5>

                    {{-- ADLERT --}}
                    {{-- ****************************************************************************** --}}
                    <section class="toast-wrapper flex-row-reverse">
                        @include('components.alerts.toast.success')
                        @include('components.alerts.toast.error')
                    </section>

                    {{-- ****************************************************************************** --}}

                    @include('errors.form_error')

                    <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                        <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>

                    <label class="font-weight-bold" for="tables">انتخاب نام جدول</label>
                    <select onchange="getSelectedValue()" id="tables" name="tables"
                        class="form-control form-control-sm">
                        <option value=""></option>
                        @foreach ($tableNames as $tableName)
                            @foreach ($tableName as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        @endforeach
                    </select>

                    <form action="{{ route('admin.setting.reset') }}" method="post">
                        @csrf
                        @method('put')

                        <input class="form-control form-control-sm" type="hidden" name="table" id="table">
                        <br>

                        <section class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                        </section>

                    </form>

                </section>

            </section>
        </section>
    @endsection

    @section('script')
        <script src="{{ asset('script/all.js') }}"></script>

        <script>
            function getSelectedValue() {
                var selectedValue = document.getElementById("tables").value;
                var _optionSelected = document.getElementById("table").value;
                _optionSelected.length ? document.getElementById("table").value = selectedValue : document
                    .getElementById("table").value = selectedValue;
            }
        </script>
    @endsection
