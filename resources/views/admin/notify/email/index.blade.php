@extends('admin.layouts.master')


@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.email_index') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه ایمیلی </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اطلاعیه ایمیلی
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
                    <a href="{{ route('admin.notify.email.create') }}" class="btn btn-info btn-sm">ایجاد ایمیل</a>
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
                                <th class="col-md-3">عنوان ایمیل</th>
                                <th class="col-md-2">محتوای ایمیل</th>
                                <th class="col-md-2">تاریخ انتشار</th>
                                <th class="col-md-1">وضعیت</th>
                                <th class="max-width-16-rem text-center col-md-4"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($emails as $email)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $email->body }}</td>
                                    <td>{{ jalali_date($email->published_at, 'H:i:s Y-%m-d') }} </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $email->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $email->id }}"
                                                data-url="{{ route('admin.notify.email.status', $email) }}" data-field="{{ $email->subject }}"
                                                @if ($email->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $email->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="width-16-rem text-center">
                                        <a href="{{ route('admin.notify.email-file.index', $email->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-file"></i> فایل های ضمیمه شده</a>

                                        <a href="{{ route('admin.notify.email.edit', $email->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> ویرایش</a>


                                        <form class="d-inline"
                                            action="{{ route('admin.notify.email.destroy', $email->id) }}" method="post">
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

                <div class="d-flex justify-content-center">
                    {{ $emails->onEachSide(5)->links() }}
                </div>

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
        function changeStatus(id) {
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
