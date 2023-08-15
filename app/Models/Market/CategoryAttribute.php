<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'type','unit','category_id'];
    protected $table = 'category_attributes';
    protected $casts = ['image' => 'array'];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }
}
