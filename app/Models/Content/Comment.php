<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['body','parent_id','auther_id','commentable_id','commentable_type','approved','status','seen'];
    protected $table = 'comments';


    //رابطه چند ریختی با جدولی که درج پست داشته
    public function commentable(){
        return $this->morphTo();
    }


    //رابطه کاربری که درج کامنت داشته
    public function user(){
        return $this->belongsTo(User::class, 'auther_id');
    }

    //رابطه جدول کامنت با خودش - یعنی هر نظر پاسخ کدام نظر قبلی است
    public function parent(){
        return $this->belongsTo($this,'parent_id');
    }

    //رابطه جدول کامنت با خودش - یعنی یک نظر چندین فرزند دارد
    public function answers(){
        return $this->hasMany($this,'parent_id');
    }

}
