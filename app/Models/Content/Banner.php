<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','image','url','position','status'];
    protected $casts = ['image' => 'string'];

    public static $positions = [
        0 => 'اسلاید شو (صفحه اصلی)',
        1 => 'کنار اسلاید شو (صفحه اصلی)',
        2 => 'دور بنر تبلیغی بین دو اسلایدر (صفحه اصلی)',
        3 => 'بنر تبلیغی بزرگ پایین دو اسلاید (صفحه اصلی)',
    ];
}
