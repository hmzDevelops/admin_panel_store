<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','url','status','parent_id'];
    protected $table = 'menus';


    public function parent(){
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children(){
        return $this->hasMany($this, 'parent_id')->with('children');
    }

}
