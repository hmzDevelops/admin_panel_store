@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.ticket_priority_edit') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اولویت </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش  اولویت بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد  اولویت بندی
                    </h5>
                </section>

                @include('errors.form_error')

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.ticket.priority.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.ticket.priority.update', $ticketPriority) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-6 form-group">
                                <label class="font-weight-bold" for="name">نام دسته</label>
                                <input value="{{ old('name', $ticketPriority->name) }}" type="text" name="name" id="name" class="form-control form-control-sm">
                                @error('name')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 form-group">
                                <label class="font-weight-bold" for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $ticketPriority->status) == 0) selected @endif>غیر فعال
                                    </option>
                                    <option value="1" @if (old('status', $ticketPriority->status) == 1) selected @endif>فعال</option>
                                </select>

                                @error('status')
                                    <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm">ویرایش</button>
                            </section>
                        </section>


                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
