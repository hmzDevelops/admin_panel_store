<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashPayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "cash_payments";


    //ارتباط چند ریختی با جدول پیمنت
    public function payments(){
        return $this->morphMany('App\Models\Market\Payment', 'paymentable');
    }
}
