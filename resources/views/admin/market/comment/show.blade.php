@extends('admin.layouts.master')



@section('page-title')
    <title>{{ config('constants.page_title.show_comment') }}</title>
@endsection


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه </a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> نظرات </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظرها </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-content-center mt-4 mb-3">
                    <a href="{{ route('admin.market.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $comment->user->fullName }} - {{ $comment->user->id }}
                    </section>

                    <section class="card-body">
                        <h5 class="card-title">کد کالا: {{ $comment->commentable->id }} - نام کالا:
                            {{ $comment->commentable->title }}</h5>
                        <p class="card-text">{{ $comment->body }}</p>
                    </section>
                </section>


                @if ($comment->parent_id == null)
                    <section>

                        <form action="{{ route('admin.market.comment.answer', $comment) }}" method="post">
                            @csrf

                            <section class="row">

                                <section class="col-12 form-group">
                                    <label for="">پاسخ ادمین</label>
                                    <textarea class="form-control form-control-sm" rows="4" name="body"></textarea>
                                    @error('body')
                                        <span class="alert alert-danger invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </section>



                                <section class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>


                        </form>

                    </section>
                @endif

            </section>
        </section>
    </section>
@endsection
