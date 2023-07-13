@extends('admin.layouts.master')

@section('page-title')
    <title>{{ config('constants.page_title.product'); }}</title>
@endsection


@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالاها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                          کالاها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد کالای جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" name="search" class="form-control form-control-sm form-text"
                            placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کالا</th>
                                <th>تصویر</th>
                                <th>قیمت</th>
                                <th>وزن</th>
                                <th>دسته</th>
                                <th>فرم</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>تلویزیون</th>
                                <th><img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" class="w-25" alt="product"></th>
                                <th>120.000</th>
                                <th>15</th>
                                <th>کالای الکترونیک</th>
                                <th>اندازه نمایشگر</th>
                                <td class=" text-center">

                                    <div class="dropdown">
                                        <a id="dropdownMenuLink" role="button" href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" data-toggle="dropdown" arial-expanded="false">
                                            <i class="fa fa-tools"></i>
                                            عملیات
                                        </a>

                                        <div class="dropdown-menu" arial-labelledby="dropdownMenuLink">
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-images"></i> گالری </a>
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-list-ul"></i> فرم کالا  </a>
                                            <a href="" class="dropdown-item text-right"><i class="fa fa-edit"></i> ویرایش  </a>
                                            <form action="" method="post">
                                                <button type="submit" class="dropdown-item"><i class="fa fa-window-close"></i> حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
