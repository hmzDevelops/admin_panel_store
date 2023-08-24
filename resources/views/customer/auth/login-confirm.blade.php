@extends('customer.layouts.master-simple')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{ route('auth.customer.login-confirm', $token) }}" method="post">
            @csrf

            @include('errors.form_error')
            
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
                </section>
                <section class="login-title">
                    <a href="{{ route('auth.customer.login-register-form') }}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </section>
                @if ($otp->type == 0)
                    <section class="login-info">کد تائید به شماره {{ $otp->login_id }} ارسال شد</section>
                @elseif($otp->type == 1)
                    <section class="login-info">کد تائید به ایمیل {{ $otp->login_id }} ارسال شد</section>
                @endif
                <section class="login-input-text">
                    <input type="text" name="otp" value="{{ old('otp') }}">
                    @error('otp')
                        <span class="alert alert-danger invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2"><button class="btn btn-danger">تائید</button></section>

            <section id="resend-otp" class="d-none">
                <a href="{{ route('auth.customer.login-resend-otp', $token) }}" class="text-decoration-none text-primary">دریافت مجدد کد تائید</a>
            </section>
            <section id="timer" class="font-size-15"></section>

            </section>
        </form>
    </section>
@endsection


@section('script')

@php
    $timer = ((new \Carbon\Carbon($otp->created_at))->addMinute(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
@endphp


<script>

    var countDateTime = new Date().getTime() + {{ $timer }};
    var timer = $('#timer');
    var resend = $('#resend-otp');

    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDateTime - now;

        var minute = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var second = Math.floor((distance % (1000 * 60)) / (1000));

        if(minute == 0){
            timer.html('ارسال مجدد کد تائید تا ' + second + ' ثانیه دیگر ');
        }else{
            timer.html('ارسال مجدد کد تائید تا ' + minute + 'دقیقه و ' + second + ' ثانیه دیگر');
        }

        if(distance < 0){
            clearInterval(x);
            timer.addClass('d-none');
            resend.removeClass('d-none');
        }

    }, 1000);

</script>
@endsection
