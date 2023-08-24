@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>جزئیات سفارش</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        جزئیات سفارش
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



                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                            <tr style="font-size: 12px;">

                                <th>#</th>
                                <th>نام محصول</th>
                                <th>درصد فروش فوق العاده</th>
                                <th>مبلغ فروش فوق العاده</th>
                                <th>تعداد</th>
                                <th>جمع قیمت محصول</th>
                                <th>مبلغ نهایی</th>
                                <th>رنگ</th>
                                <th>گارانتی</th>
                                <th>ویژگی</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->singleProduct->name ?? '-' }}</td>
                                    <td>{{ $item->amazingSale->percentage ?? '-' }}</td>
                                    <td>{{ $item->amazing_sale_discount_amount ?? '-' }}</td>
                                    <td>{{ $item->number ?? '-' }}</td>
                                    <td>{{ $item->final_product_price ?? '-' }}</td>
                                    <td>{{ $item->final_total_price ?? '-' }}</td>
                                    <td>{{ $item->color->color_name ?? '-' }}</td>
                                    <td>{{ $item->guarantee->name ?? '-' }}</td>
                                    <td>
                                        @forelse ($item->orderItemAttributes as $attribute)
                                            {{ $attribute->categoryAttribute->name ?? '-' }} :
                                            {{ json_decode($attribute->categoryAttributeValue->value)->value ?? '-' }}
                                        @empty
                                            -
                                        @endforelse
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
