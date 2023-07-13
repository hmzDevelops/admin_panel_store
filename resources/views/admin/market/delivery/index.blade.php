@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.delivery'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.category.index') }}">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> روش های ارسال </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          روش های ارسال
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.delivery.create') }}" class="btn btn-info btn-sm">ایجاد روش ارسال </a>
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
                                <th class="col-md-3">روش ارسال</th>
                                <th class="col-md-3">هزینه ارسال</th>
                                <th class="col-md-2">زمان ارسال</th>
                                <th class="max-width-16-rem text-center col-md-3"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>پیشتاز</td>
                                <td>85.000 تومان</td>
                                <td>1402.10.12</td>
                                <td class="width-16-rem text-center">
                                    <a href="#" class="btn btn-info btn-sm w-6"><i class="fa fa-eye"></i> نمایش</a>
                                    <button class="btn btn-success btn-sm w-6" type="submit"><i class="fa fa-check"></i>
                                        تائید</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
