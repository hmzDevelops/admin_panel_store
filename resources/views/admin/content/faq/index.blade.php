@extends('admin.layouts.master')


@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection


@section('page-title')
    <title>{{ config('constants.page_title.faq_index') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        سوالات متداول
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
                    <a href="{{ route('admin.content.faq.create') }}" class="btn btn-info btn-sm">ایجاد سوال</a>
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
                                <th class="col-md-4">پرسش</th>
                                <th class="col-md-3">خلاصه پاسخ</th>
                                <th class="col-md-1">وضعیت</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <th>{{ $faq->interation }}</th>
                                    <td>{{  Str::limit($faq->question, $limit = 50, $end = '...') }} </td>
                                    <td>{{ Str::limit($faq->answer, $limit = 30, $end = '...') }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $faq->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $faq->id }}"
                                                data-url="{{ route('admin.content.faq.status', $faq) }}"
                                                @if ($faq->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $faq->id }}"></label>
                                        </div>

                                    </td>
                                    <td class="width-16-rem text-center">
                                        <a href="{{ route('admin.content.faq.edit', $faq) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                            ویرایش</a>
                                        <form class="d-inline" action="{{ route('admin.content.faq.destroy', $faq->id) }}"
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

                <div class="d-flex justify-content-center">
                    {{ $faqs->onEachSide(5)->links() }}
                </div>

            </section>
        </section>
    </section>
@endsection


{{-- load sweetalert2 js --}}
@section('script')
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.all.min.js') }}"></script>
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.min.js') }}"></script>

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


    <script src="{{ asset('script/all.js') }}"></script>
    
    {{-- AJAX STATUS --}}
    <script text="type/javascript">
        function changeStatus(id) {
            var element = $('#' + id);
            var ajaxUrl = element.attr('data-url');
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
                            successToast('وضعیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            warningToast('وضعیت غیر فعال شد');
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
@endsection
