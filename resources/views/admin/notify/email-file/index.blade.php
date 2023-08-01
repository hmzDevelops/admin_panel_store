@extends('admin.layouts.master')


@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.public_email_file') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاعیه ایمیلی </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فایلهای اطلاعیه ایمیلی </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فایلهای اطلاعیه ایمیلی
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
                        <a href="{{ route('admin.notify.email-file.create', $email->id) }}"
                            class="btn btn-info btn-sm">ایجاد فایل</a>
                        <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
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
                                <th class="col-md-3">عنوان ایمیل</th>
                                <th class="col-md-2">سایز فایل</th>
                                <th class="col-md-2">نوع فایل</th>
                                <th class="col-md-2">محل فایل</th>
                                <th class="col-md-1">وضعیت</th>
                                <th class="max-width-16-rem text-center col-md-2"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($email->files as $file)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ number_format((float)($file->file_size / 1024), 0, '.', '') . " کیلوبایت" }}</td>
                                    <td>{{ $file->file_type }}</td>
                                    <td>{{ $file->file_location == 1 ? "Public" : "Storage" }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $file->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $file->id }}"
                                                data-url="{{ route('admin.notify.email-file.status', $file) }}"
                                                data-field="{{ $file->subject }}"
                                                @if ($file->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $file->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="width-16-rem text-center">


                                        <a href="{{ route('admin.notify.email-file.edit', $file->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i> ویرایش</a>


                                        <form class="d-inline"
                                            action="{{ route('admin.notify.email-file.destroy', $file->id) }}" method="post">
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
