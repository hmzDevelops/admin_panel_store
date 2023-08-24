@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.order') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        سفارشات
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
                    <a href="" class="btn btn-info btn-sm disabled">ایجاد سفارش</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                            <tr style="font-size: 12px;">
                                <th>کد سفارش</th>
                                <th>مجموع سفارش-تومان( بدون تخفیف)</th>
                                <th>مجموع تخفیف-تومان</th>
                                <th>مبلغ تخفیف همه محصولات-تومان</th>
                                <th>مبلغ نهایی-تومان</th>
                                <th>وضعیت پرداخت</th>
                                <th>شیوه پرداخت</th>
                                <th>بانک</th>
                                <th>وضعیت ارسال</th>
                                <th>شیوه ارسال</th>
                                <th>وضعیت سفارش</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->orderFinalAmountFormatted }}</td>
                                    <td>{{ $order->orderDiscountAmountFormatted }}</td>
                                    <td>{{ $order->orderTotalProductsDiscountAmountFormatted }}</td>
                                    <td>{{ $order->orderTotalFinalFormatted }}</td>
                                    <td>{{ $order->payment_status_value }} </td>
                                    <td>{{ $order->payment_type_value }} </td>
                                    <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                    <td>{{ $order->delivery_status_value }}</td>
                                    <td>{{ $order->delivery->name ?? '-' }}</td>
                                    <td>{{ $order->order_status_value }}</td>
                                    <td class=" text-center">

                                        <div class="dropdown">
                                            <a id="dropdownMenuLink" role="button" href="#"
                                                class="btn btn-success btn-sm btn-block dropdown-toggle"
                                                data-toggle="dropdown" arial-expanded="false">
                                                <i class="fa fa-tools"></i>
                                                عملیات
                                            </a>

                                            <div class="dropdown-menu" arial-labelledby="dropdownMenuLink">
                                                <a href="{{ route('admin.market.order.show', $order) }}" class="dropdown-item text-right"><i
                                                        class="fa fa-images"></i> مشاهده فاکتور</a>
                                                <a href="{{ route('admin.market.order.changeSendStatus', $order) }}" class="dropdown-item text-right"><i
                                                        class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                                <a href="{{ route('admin.market.order.changeOrderStatus', $order) }}" class="dropdown-item text-right"><i
                                                        class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                                <a href="{{ route('admin.market.order.cancelOrder', $order) }}" class="dropdown-item text-right"><i
                                                        class="fa fa-window-close"></i> باطل کردن سفارش</a>
                                            </div>
                                        </div>
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

    <script src="{{ asset('script/all.js') }}"></script>

    {{-- confirm delete --}}
    <script>
        $(function() {
            $(".delete").on("click", function(e) {

                e.preventDefault();

                Swal.fire({
                    title: "آیا نسبت به حذف مطمئن هستید؟",
                    showDenyButton: true,
                    icon: "info",
                    confirmButtonText: "بله",
                    denyButtonText: "خیر",
                    confirmButtonColor: "#28A745",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    } else if (result.isDenied) {
                        //
                    }
                });
            });
        });
    </script>
@endsection
