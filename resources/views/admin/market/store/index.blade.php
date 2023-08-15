@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.store') }}</title>
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
                                <th >#</th>
                                <th class="col-md-4">نام کالا</th>
                                <th class="col-md-1">تصویر کالا</th>
                                <th class="col-md-1">تعداد قابل فروش</th>
                                <th class="col-md-1">تعداد رزرو شده</th>
                                <th class="col-md-2">تعداد فروخته شده</th>
                                <th class="max-width-16-rem text-center col-md-2"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td><img width="50" height="50"
                                        src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                        alt="{{ $product->name }}">
                                    </td>
                                    <td>{{ $product->marketable_number }}</td>
                                    <td>{{ $product->frozen_number }}</td>
                                    <td>{{ $product->sold_number }}</td>
                                    <td class="width-16-rem text-center">
                                        <a href="{{ route('admin.market.store.addToStore', $product) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>

                                            <a href="{{ route('admin.market.store.edit', $product) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i> اصلاح موجودی</a>
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
