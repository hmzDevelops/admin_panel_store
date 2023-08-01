<?php

namespace App\Models\Content;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $casts = ['image' => 'array'];
    protected $fillable = ['title','summary','slug','image','status','tags','body','published_at','auther_id', 'category_id', 'commentable'];

    public function sluggable():array{
        return [
            'slug' => ['source' => 'title'],
        ];
    }


    //رابطه تعلق داشتن پست به کدام دسته
    public function category(){
        return $this->belongsTo(PostCategory::class, 'category_id');
    }


    //رابطه چند به چند با جدول کامنت
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

}
