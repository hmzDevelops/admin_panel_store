@extends('admin.layouts.master')


@section('page-title')
    <title>{{ config('constants.page_title.role_permission') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نقش ها </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی های نقش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسترسی های نقش
                    </h5>
                </section>

                @include('errors.form_error')


                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.user.role.permission.update', $role) }}" method="post">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-5 form-group">
                                <label class="font-weight-bold" for="name">عنوان نقش</label>
                                <span>{{ $role->name }}</span>
                            </section>

                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">

                                    @php
                                        $rolePermissionArray = $role->permissions->pluck('id')->toArray();
                                    @endphp

                                    @foreach ($permissions as $key => $permission)
                                        <section class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input form-control-sm"
                                                    id="{{ $permission->id }}" value="{{ $permission->id }}"
                                                    name="permissions[]" @if (in_array($permission->id, $rolePermissionArray)) checked @endif>
                                                <label class="form-check-label font-weight-bold mr-3 mt-2"
                                                    for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>

                                            @error('permissions.' . $key)
                                                <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </section>
                                    @endforeach

                                    <section class="col-12 col-md-2 mt-4">
                                        <button type="submit" class="btn btn-primary btn-sm">ویرایش</button>
                                    </section>

                                </section>
                            </section>
                        </section>

                    </form>

                </section>

            </section>
        </section>
    </section>
@endsection
