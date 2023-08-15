<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['persian_name','orginal_name','slug','logo','status','tags'];
    protected $table = 'brands';


    public function sluggable():array{
        return [
            'slug' => ['source' => 'orginal_name'],
        ];
    }


    protected $casts = ['logo' => 'array'];

    
    public function brands(){
        return $this->hasMany(Product::class);
    }
}
