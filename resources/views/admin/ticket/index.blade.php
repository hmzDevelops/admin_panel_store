@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/components/sweetalert2/sweetalert2.v.11.7.18.min.css') }}">
@endsection

@section('page-title')
    <title>{{ config('constants.page_title.ticket_index') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت ها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         {{ $ticketPageTitle }}
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
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد تیکت</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="col-md-2">نویسنده تیکت</th>
                                <th class="col-md-2">عنوان تیکت</th>
                                <th class="col-md-2">دسته تیکت</th>
                                <th class="col-md-1">اولویت تیکت</th>
                                <th class="col-md-1">ارجاع شده از</th>
                                <th class="col-md-1">تیکت مرجع</th>
                                <th class="col-md-1">تیکت باز/بسته</th>
                                <th class="max-width-16-rem text-center col-md-2"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $ticket->user->fullName }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->ticketCategory->name }}</td>
                                    <td>{{ $ticket->ticketPriority->name }}</td>
                                    <td>{{ $ticket->admin->user->fullName }}</td>
                                    <td>{{ $ticket->parent->subject ?? 'فاقد والد' }}</td>

                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                            <input onchange="changeStatus({{ $ticket->id }})" type="checkbox"
                                                class="custom-control-input" id="{{ $ticket->id }}"
                                                data-url="{{ route('admin.ticket.change', $ticket) }}" data-field="{{ $ticket->subject }}"
                                                @if ($ticket->status == 1) checked @endif>
                                            <label class="custom-control-label" for="{{ $ticket->id }}"></label>
                                        </div>
                                    </td>

                                    <td class="width-16-rem text-center">
                                        <a href="{{ route('admin.ticket.show', $ticket) }}"
                                            class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> مشاهده</a>
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
                            successToast('وضعیت تیکت ' + field + ' باز شد');
                        } else {
                            element.prop('checked', false);
                            warningToast('وضعیت تیکت ' + field + '  بسته شد');
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
