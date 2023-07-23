@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('style/page_404/style.css') }}">

    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            border: 3px solid green;
        }

    </style>
@endsection

@section('page-title')
    <title>404 Error </title>
@endsection


@section('content')
    <!-- partial:index.partial.html -->
    <div class="container col-12">
        <h1 class="first-four">4</h1>
        <div class="cog-wheel1">
            <div class="cog1">
                <div class="top"></div>
                <div class="down"></div>
                <div class="left-top"></div>
                <div class="left-down"></div>
                <div class="right-top"></div>
                <div class="right-down"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>

        <div class="cog-wheel2 ">
            <div class="cog2">
                <div class="top"></div>
                <div class="down"></div>
                <div class="left-top"></div>
                <div class="left-down"></div>
                <div class="right-top"></div>
                <div class="right-down"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>

        <h1 class="second-four">4</h1>
        <p class="wrong-para">صفحه مورد نظر یافت نشد!- <a href="{{ route('admin.home') }}">خانه</a></p><br>

    </div>
@endsection

@section('script')
    <script src="{{ asset('script/page_404/gsap.3.3.1.js') }}"></script>
    <script src="{{ asset('script/page_404/script.js') }}"></script>
@endsection
