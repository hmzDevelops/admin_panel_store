<?php

namespace App\Http\Controllers\Auth\customer;

use Throwable;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Message\MSGSerivce;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Requests\auth\customer\LoginRegisterRequest;

class LoginRegisterController extends Controller
{
    //

    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $emailOrMobile = $inputs['id'];

        if (filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL)) {

            $type = 1; // 1 => email
            $user = User::where('email', $emailOrMobile)->first();

            if (empty($user)) {
                $newUser['email'] = $emailOrMobile;
            }
        } elseif (preg_match('/^(\+98|98|0)9\d{9}$/', $emailOrMobile)) {
            $type = 0; // 0 => mobile

            //all mobile numbers are on format: 9** *** ****
            $emailOrMobile = ltrim($emailOrMobile, '0');
            $emailOrMobile = substr($emailOrMobile, 0, 2) === '98' ? substr($emailOrMobile, 2) : $emailOrMobile;
            $emailOrMobile = str_replace('+98', '', $emailOrMobile);


            $user = User::where('mobile', $emailOrMobile)->first();

            if (empty($user)) {
                $newUser['mobile'] = $inputs['id'];
            }
        } else {
            $errorText = "شناسه ورودی شما معتبر نیست";
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id', $errorText]);
        }


        if (empty($user)) {
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }


        //create otp code
        $otpCode =  rand(111111, 999999);
        $token  = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $inputs['id'],
            'type' => $type,
        ];

        Otp::create($otpInputs);


        //send sms or email

        if ($type == 0) {
            //send sms

        } else if ($type == 1) {
            //send email

            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعالسازی',
                'body' => "کد فعالسازی شما: $otpCode",
            ];
            $emailService->setDetails($details);
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($inputs['id']);


            try {
                $msgService = new MSGSerivce($emailService);
                $msgService->send();
            } catch (Throwable $e) {

                //error handeling
                Log::error(['errorCode' => $e->getCode()]);
                if ($e->getCode() == 0) {
                    $errorMsg = "لطفا اتصال به اینترنت را بررسی نمایید";
                }
                return redirect()->route('auth.customer.login-register-form')->withErrors($errorMsg);
            }
        }

        return redirect()->route('auth.customer.login-confirm-form', $token);
    }


    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token', $token)->first();
        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => 'آدرس وارد شده معتبر نمی باشد']);
        }

        return view('customer.auth.login-confirm', compact('token', 'otp'));
    }




    public function loginConfirm($token, LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        $otp = Otp::where('token', $token)->where('otp_code', $inputs['otp'])->where('used', 0)->where('created_at', '>=', Carbon::now()->subMinute(5)->toDateTimeString())->first();

        if (empty($otp)) {
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors('کد وارد شده معتبر نمی باشد');
        }


        //everything is ok
        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        if ($otp->type == 0 && empty($user->mobile_verified_at)) {

            $user->update(['mobile_verified_at' => Carbon::now()]);
        } else if ($otp->type == 1 && empty($user->email_verified_at)) {

            $user->update(['email_verified_at' => Carbon::now()]);
        }

        Auth::login($user);
        return redirect()->route('customer.home');
    }



    public function loginResenOtp($token)
    {

        $otp = Otp::where('token', $token)->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();

        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form', $token)->withErrors('آدرس وارد شده نامعتبر است');
        }


        $user = $otp->user()->first();

        //create otp code
        $otpCode =  rand(111111, 999999);
        $newToken  = Str::random(60);
        $otpInputs = [
            'token' => $newToken,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $otp->login_id,
            'type' => $otp->type,
        ];

        Otp::create($otpInputs);


        //send sms or email

        if ($otp->type == 0) {
            //send sms

        } else if ($otp->type == 1) {
            //send email

            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعالسازی',
                'body' => "کد فعالسازی شما: $otpCode",
            ];
            $emailService->setDetails($details);
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($otp->login_id);


            try {
                $msgService = new MSGSerivce($emailService);
                $msgService->send();
            } catch (Throwable $e) {

                //error handeling
                Log::error(['errorCode' => $e->getCode()]);
                if ($e->getCode() == 0) {
                    $errorMsg = "لطفا اتصال به اینترنت را بررسی نمایید";
                }
                return redirect()->route('auth.customer.login-register-form')->withErrors($errorMsg);
            }
        }

        return redirect()->route('auth.customer.login-confirm-form', $newToken);
    }



    public function logout(){
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
