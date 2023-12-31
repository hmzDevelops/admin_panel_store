<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['name','description','slug','image','status','tags'];
    protected $table = 'post_categories';
    
    public function sluggable():array{
        return [
            'slug' => ['source' => 'name'],
        ];
    }



    protected $casts = ['image' => 'array'];


}
