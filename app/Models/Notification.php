<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['data' => 'array'];

    //ایجاد پیغام پس از ساختن کاربر جدید
}
