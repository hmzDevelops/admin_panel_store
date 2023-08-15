@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.payment') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پرداخت ها
                    </h5>
                </section>

                  {{-- ADLERT --}}
                {{-- ****************************************************************************** --}}
                <section class="toast-wrapper flex-row-reverse">
                    @include('components.alerts.toast.success')
                    @include('components.alerts.toast.error')
                </section>

                @include('components.alerts.sweetalert2.success')
                @include('components.alerts.sweetalert2.error')

                {{-- ****************************************************************************** --}}


                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="#" class="btn btn-info btn-sm disabled">پرداخت جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="col-md-4">کد تراکنش</th>
                                <th class="col-md-1">بانک</th>
                                <th class="col-md-2">پرداخت کننده</th>
                                <th class="col-md-1">وضعیت پرداخت</th>
                                <th class="col-md-1">نوع پرداخت</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                                    <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                                    <td>{{ $payment->user->full_name }}</td>
                                    <td>@if ($payment->status == 0) پرداخت نشده @elseif ($payment->status == 1) پرداخت شده @elseif ($payment->status == 2)  باطل شده @else برگشت داده شده@endif</td>
                                    <td>@if ($payment->type == 0) آنلاین @elseif ($payment->type == 1) آفلاین @else  نقدی @endif</td>
                                    <td class="width-16-rem text-center">
                                        <a href="{{ route('admin.market.payment.show', $payment) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                                        <a href="{{ route('admin.market.payment.canceled', $payment) }}" class="btn btn-warning btn-sm"><i class="fas fa-ban"></i> باطل
                                            کردن</a>
                                        <a href="{{ route('admin.market.payment.returned', $payment) }}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>
                                            برگرداندن</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection

{{-- load sweetalert2 js --}}
@section('script')
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.all.min.js') }}"></script>
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.min.js') }}"></script>

@endsection
