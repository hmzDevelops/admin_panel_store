@extends('admin.layouts.master')

@section('style')
    {{-- jalali datapicker --}}
    <link rel="stylesheet" href="{{ asset('style/components/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.create_copan_discount') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کوپن تخفیف
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copan.update', $copan) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 form-group">
                                <label for="code" class="font-weight-bold">کد کوپن</label>
                                <input type="text" class="form-control form-control-sm" name="code"
                                    value="{{ old('code', $copan->code) }}">
                                @error('code')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label for="type" class="font-weight-bold">نوع کوپن</label>
                                <select name="type" id="type" class="form-control form-control-sm" name="type" >
                                    <option value="0" @if (old('type', $copan->type) == 0) selected @endif>عمومی</option>
                                    <option value="1" @if (old('type', $copan->type) == 1) selected @endif>خصوصی</option>
                                </select>
                                @error('type')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="user_id" class="font-weight-bold">کاربران</label>
                                <select name="user_id" id="users" class="form-control form-control-sm" @if ($copan->type == 0) disabled @endif>
                                    @foreach ($users as $user)
                                        <option @if (old('user_id', $copan->user_id) == $user->id) selected @endif
                                            value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="amount_type" class="font-weight-bold">نوع تخفیف</label>
                                <select name="amount_type" class="form-control form-control-sm">
                                    <option value="0" @if (old('amount_type', $copan->amount_type) == 0) selected @endif>درصدی</option>
                                    <option value="1" @if (old('amount_type', $copan->amount_type) == 1) selected @endif>عددی</option>
                                </select>
                                @error('amount_type')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 form-group">
                                <label for="amount" class="font-weight-bold">میزان تخفیف</label>
                                <input type="text" class="form-control form-control-sm" name="amount"
                                    value="{{ old('amount', $copan->amount) }}">
                                @error('amount')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label for="discount_ceiling" class="font-weight-bold">حداکثر تخفیف</label>
                                <input type="text" class="form-control form-control-sm" name="discount_ceiling"
                                    value="{{ old('discount_ceiling', $copan->discount_ceiling) }}">
                                @error('discount_ceiling')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="start_date">تاریخ شروع</label>
                                <input type="text" name="start_date" id="start_date"
                                    class="d-none form-control form-control-sm">
                                <input type="text" id="start_date_view" class="form-control form-control-sm"
                                    value="{{ old('start_date', $copan->start_date) }}">

                                @error('start_date')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="end_date">تاریخ پایان</label>
                                <input type="text" name="end_date" id="end_date"
                                    class="d-none form-control form-control-sm">
                                <input type="text" id="end_date_view" class="form-control form-control-sm",
                                    value="{{ old('start_date', $copan->end_date) }}">

                                @error('end_date')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </section>


                            <section class="col-12 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $copan->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $copan->status) == 1) selected @endif>فعال</option>
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

@section('script')
    {{-- jalali datepicker --}}
    <script src="{{ asset('script/components/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('script/components/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date',
            }), $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date',
            });
        });
    </script>



    <script>

        $('#type').on('change', function() {
            if ($('#type').find(':selected').val() == '1') {
                $('#users').removeAttr('disabled');
            } else {
                $('#users').attr('disabled', 'disabled');
            }
        });
    </script>
@endsection
