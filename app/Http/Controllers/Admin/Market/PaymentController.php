<?php

namespace App\Http\Controllers\admin\market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        return view('admin.market.payment.index');
    }


    public function online()
    {
        return view('admin.market.payment.index');
    }

    public function offline()
    {
        return view('admin.market.payment.index');
    }

    public function attendance()
    {
        return view('admin.market.payment.index');
    }

    public function confirm()
    {
        return view('admin.market.payment.index');
    }
}
