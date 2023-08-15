@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.form_property') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقدار فرم کالا </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        مقدار فرم کالا
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
                    <div>
                    <a href="{{ route('admin.market.value.create', $category_attribute) }}" class="btn btn-info btn-sm">ایجاد مقدار فرم کالای جدید</a>
                    <a href="{{ route('admin.market.property.index') }}" class="btn btn-dark btn-sm">بازگشت</a>
                </div>
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
                                <th class="col-md-2">نام فرم</th>
                                <th class="col-md-2">نام محصول</th>
                                <th class="col-md-2">مقدار</th>
                                <th class="col-md-2">افزایش قیمت</th>
                                <th class="col-md-1">نوع</th>
                                <th class="max-width-16-rem text-center col-md-2"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($category_attribute->values as $value)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $value->attribute->name }}</td>
                                    <td>{{ $value->product->name }}</td>
                                    <td>{{ json_decode($value->value)->value }}</td>
                                    <td>{{ json_decode($value->value)->price_increase }}</td>
                                    <td>{{ $value->type == 0 ? 'ساده' : 'انتخابی'}}</td>
                                    <td class="width-16-rem text-center">

                                        <a href="{{ route('admin.market.value.edit', ['category_attribute' => $category_attribute, 'value' => $value]) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form class="d-inline"
                                            action="{{ route('admin.market.value.destroy', ['category_attribute' => $category_attribute, 'value' => $value]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')

                                            <button class="btn btn-danger btn-sm delete">
                                                <i class="fa fa-trash-alt"></i>
                                                حذف</button>
                                        </form>

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
