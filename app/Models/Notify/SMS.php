<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SMS extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','status','body','published_at'];
    protected $table = 'public_sms';
}
