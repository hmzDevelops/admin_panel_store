<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['subject','status','body','published_at'];
    protected $table = 'public_mail';


    public function files(){
        return $this->hasMany(EmailFile::class, 'public_mail_id');
    }
}
