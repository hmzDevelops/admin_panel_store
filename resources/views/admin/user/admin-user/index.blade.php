@extends('admin.layouts.master')


@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.admin_user_index') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کاربران ادمین
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
                    <a href="{{ route('admin.user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-2">ایمیل</th>
                                <th class="col-md-1">موبایل</th>
                                <th class="col-md-1">نام</th>
                                <th class="col-md-1">نقش</th>
                                <th class="col-md-1">وضعیت</th>
                                <th class="col-md-1">فعالسازی</th>
                                <th class="col-md-1">حذف</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>{{ $admin->firstname }}</td>
                                    <td>{{ $admin->user_type == 1 ? 'ادمین' : 'عادی' }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $admin->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $admin->id }}-status"
                                                data-url="{{ route('admin.user.status', $admin) }}"
                                                data-field="{{ $admin->firstname }}"
                                                @if ($admin->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $admin->id }}-status"></label>
                                        </div>

                                    </td>

                                    <td>
                                        <div class="custom-control custom-switch">

                                            <input onchange="changeActivation({{ $admin->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $admin->id }}"
                                                data-url="{{ route('admin.user.activation', $admin) }}"
                                                data-field="{{ $admin->firstname }}"
                                                @if ($admin->activation == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $admin->id }}"></label>
                                        </div>

                                    </td>
                                    <td>
                                        @if ($admin->deleted_at == null)
                                            <i id="{{ $admin->id }}-delete" data-url="{{ route('admin.user.soft', $admin) }}"
                                            data-field="{{ $admin->firstname }} data-value="undelete" class="fa text-success fa-check1" aria-hidden="true" ></i><span class="text-success">فعال</span>
                                        @else
                                        <i id="{{ $admin->id }}-delete" data-url="{{ route('admin.user.soft', $admin) }}"
                                            data-field="{{ $admin->firstname }} data-value="delete" class="fa text-danger fa-trash1" aria-hidden="true" ></i><span class="text-danger">حذف شده</span>
                                        @endif

                                    </td>

                                    <td class="width-16-rem text-center">
                                        <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>نقش</a>
                                        <a href="{{ route('admin.user.edit', $admin) }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form class="d-inline" action="{{ route('admin.user.destroy', $admin) }}"
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
@endsection


@section('ajax')
    <script src="{{ asset('script/all.js') }}"></script>
    {{-- AJAX STATUS --}}

    <script text="type/javascript">
        function changeActivation(id) {
            var element = $('#' + id);
            var ajaxUrl = element.attr('data-url');
            var field = element.attr('data-field');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: ajaxUrl,
                type: 'post',
                data: {
                    "_token": $('#token').val(),
                },
                success: function(response) {
                    if (response.activation) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('فعالسازی ' + field + ' انجام شد');
                        } else {
                            element.prop('checked', false);
                            warningToast('غیر فعالسازی ' + field + ' انجام شد ');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('مجددا تلاش نمایید');
                    }
                },
                error: function(response) {
                    element.prop('checked', elementValue);
                    errorToast('خطای سرور');
                }
            });
        }

        function changeStatus(id) {
            var element = $('#' + id + '-status');
            var ajaxUrl = element.attr('data-url');
            var field = element.attr('data-field');
            var elementValue = !element.prop('checked');

            $.ajax({
                url: ajaxUrl,
                type: 'post',
                data: {
                    "_token": $('#token').val(),
                },
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('وضعیت ' + field + ' فعال شد');
                        } else {
                            element.prop('checked', false);
                            warningToast('وضعیت ' + field + ' غیر فعال شد');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('مجددا تلاش نمایید');
                    }
                },
                error: function(response) {
                    element.prop('checked', elementValue);
                    errorToast('خطای سرور');
                }
            });
        }

        function changeDeleted(id) {
            var element = $('#' + id + '-delete');
            var ajaxUrl = element.attr('data-url');
            var field = element.attr('data-field');
            var elementValue = !element.prop('checked');
            var deleteState =  element.attr('data-value');

            $.ajax({
                url: ajaxUrl,
                type: 'post',
                data: {
                    "_token" : $('#token').val(),
                    "value" : deleteState,
                },
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('وضعیت ' + field + ' فعال شد');
                        } else {
                            element.prop('checked', false);
                            warningToast('وضعیت ' + field + ' غیر فعال شد');
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('مجددا تلاش نمایید');
                    }
                },
                error: function(response) {
                    element.prop('checked', elementValue);
                    errorToast('خطای سرور');
                }
            });
        }
    </script>

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
