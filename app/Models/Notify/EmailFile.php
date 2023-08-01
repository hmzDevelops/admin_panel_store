<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailFile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['public_mail_id','file_path','file_size','file_type','file_location','status'];
    protected $table = 'public_mail_files';

    public function email(){
        return $this->belongsTo(Email::class, 'public_mail_id');
    }

}


