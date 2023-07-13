@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.store'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> انبار </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          انبار
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد انبار جدید </a>
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
                                <th class="col-md-2">نام کالا</th>
                                <th class="col-md-2">تصویر کالا</th>
                                <th class="col-md-2">موجودی</th>
                                <th class="col-md-1">ورودی انبار</th>
                                <th class="col-md-1">خروجی انبار</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>تلویزیون سامسونگ</td>
                                <td><img class="w-25" src="{{ asset('admin-assets/images/avatar-3.jpg') }}" alt="kala"></td>
                                <td>50</td>
                                <td>38</td>
                                <td>22</td>
                                <td class="width-16-rem text-center">
                                    <a href="{{ route('admin.market.store.addToStore') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-trash-alt"></i>
                                        اصلاح موجودی</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
