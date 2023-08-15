@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.comment') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
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
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-0">#</th>
                                <th class="col-md-1">نظر</th>
                                <th class="col-md-1">پاسخ به</th>
                                <th class="col-md-1">مشاهده نظر</th>
                                <th class="col-md-1">کد کاربر</th>
                                <th class="col-md-2">نویسنده نظر</th>
                                <th class="col-md-1">کد پست</th>
                                <th class="col-md-1">پست</th>
                                <th class="col-md-1">وضعیت</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ Str::limit($comment->body, 10) }}</td>
                                    <td>{{ $comment->parent_id ? Str::limit($comment->parent->body, 10) : 'نظر اصلی' }}</td>
                                    <td>
                                        @if ($comment->seen)
                                            <i class="fa text-success fa-eye"></i>
                                        @else
                                            <i class="fa text-danger fa-eye-slash"></i>
                                        @endif
                                    </td>
                                    <td>{{ $comment->auther_id }}</td>
                                    <td>{{ $comment->user->fullName }}</td>
                                    <td>{{ $comment->commentable_id }}</td>
                                    <td>{{ $comment->commentable->name }}</td>

                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $comment->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $comment->id }}"
                                                data-url="{{ route('admin.market.comment.status', $comment) }}"
                                                @if ($comment->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $comment->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="width-16-rem text-center">

                                        <a href="{{ route('admin.market.comment.show', $comment) }}"
                                            class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> نمایش</a>



                                        @if ($comment->approved == 0)
                                            <button id="{{ $comment->id }}approved"
                                                onClick="changeApproved({{ $comment->id }})"
                                                data-url="{{ route('admin.market.comment.approved', $comment->id) }}"
                                                class="btn btn-warning btn-sm w-6"><i class="fa fa-clock"></i> عدم تائید
                                            </button>
                                        @else
                                            <button id="{{ $comment->id }}approved"
                                                onClick="changeApproved({{ $comment->id }})"
                                                data-url="{{ route('admin.market.comment.approved', $comment->id) }}"
                                                class="btn btn-success btn-sm w-6"><i class="fa fa-check"></i> تائید
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                <div class="d-flex justify-content-center">
                    {{ $comments->onEachSide(5)->links() }}
                </div>

            </section>
        </section>
    </section>
@endsection


{{-- load sweetalert2 js --}}
@section('script')
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.all.min.js') }}"></script>
    <script src="{{ asset('script/components/sweetalert2/sweetalert2.v.11.7.18.min.js') }}"></script>

    <script src="{{ asset('script/all.js') }}"></script>

    {{-- AJAX APPROVED --}}
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


        function changeApproved(id) {
            var element = $('#' + id + "approved");
            var ajaxUrl = element.attr('data-url');

            $.ajax({
                url: ajaxUrl,
                type: 'post',
                data: {
                    "_token": $('#token').val(),
                },
                success: function(response) {
                    if (response.approved) {
                        successToast('کامنت تائید شد');
                        element.removeClass('btn-warning');
                        element.addClass('btn-success');
                        element.html('<i class="fa fa-check"></i> تائید');
                    } else if (!response.approved) {
                        warningToast('کامنت تائید نشد');
                        element.removeClass('btn-success');
                        element.addClass('btn-warning');
                        element.html('<i class="fa fa-clock"></i> عدم تائید');
                    } else {
                        errorToast('مجددا تلاش نمایید');
                    }
                },
                error: function(response) {
                    errorToast('خطای سرور');
                }
            });
        }
    </script>
@endsection
