@extends('admin.layouts.master')

@section('style')
    <link id="swal-show" rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.product') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالاها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کالاها
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
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد کالای جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="col-md-3">نام کالا</th>
                                <th class="col-md-2">تصویر</th>
                                <th class="col-md-2">قیمت</th>
                                <th class="col-md-2">دسته</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $product->name }}</th>
                                    <th> <img width="80" height="80"
                                            src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                            alt="{{ $product->name }}"></th>



                                    <th>{{ digitGroup($product->price) }} تومان </th>
                                    <th>اندازه نمایشگر</th>
                                    <td class=" text-center">

                                        <div class="dropdown">
                                            <a id="dropdownMenuLink" role="button" href="#"
                                                class="btn btn-success btn-sm btn-block dropdown-toggle"
                                                data-toggle="dropdown" arial-expanded="false">
                                                <i class="fa fa-tools"></i>
                                                عملیات
                                            </a>

                                            <div class="dropdown-menu" arial-labelledby="dropdownMenuLink">
                                                <a href="{{ route('admin.market.gallery.index', $product) }}"
                                                    class="dropdown-item text-right"><i class="fa fa-images"></i> گالری </a>
                                                <a href="{{ route('admin.market.color.index', $product) }}"
                                                    class="dropdown-item text-right"><i class="fa fa-list-ul"></i> مدیریت
                                                    رنگ ها </a>

                                                <a href="{{ route('admin.market.guarantee.index', $product) }}"
                                                    class="dropdown-item text-right"><i class="fa fa-shield-alt"></i> مدیریت
                                                     گارانتی ها </a>
                                                <a href="{{ route('admin.market.product.edit', $product) }}"
                                                    class="dropdown-item text-right"><i class="fa fa-edit"></i> ویرایش </a>

                                                <form class="d-inline"
                                                    action="{{ route('admin.market.product.destroy', $product) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item delete"><i
                                                            class="fa fa-window-close"></i> حذف</button>
                                                </form>

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
