<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "payments";


    public function user(){
        return $this->belongsTo(User::class);
    }


    //ارتباط چند ریختی با جدول های با پسوند پیمنت
    public function paymentable(){
        return $this->morphTo();
    }

}
