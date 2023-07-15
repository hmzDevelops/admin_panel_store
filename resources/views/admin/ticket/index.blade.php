@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.ticket_index'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          تیکت
                    </h5>
                </section>

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
                                <th class="col-md-1">#</th>
                                <th class="col-md-1">نویسنده تیکت</th>
                                <th class="col-md-2">عنوان تیکت</th>
                                <th class="col-md-1">دسته تیکت</th>
                                <th class="col-md-2">اولویت تیکت</th>
                                <th class="col-md-2">ارجاع شده از</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>حامد احمدی</td>
                                <td>پرداخت انجام نمیشه</td>
                                <td>فروش</td>
                                <td>فوری</td>
                                <td>---</td>
                                <td class="width-16-rem text-center">
                                    <a href="{{ route('admin.ticket.show') }}" class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> مشاهده</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
