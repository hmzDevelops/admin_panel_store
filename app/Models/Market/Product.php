<?php

namespace App\Models\Market;

use App\Models\Market\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model

{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['name', 'introduction', 'slug', 'image', 'status', 'tags', 'weight', 'length', 'width', 'height', 'price', 'marketable', 'sold_number', 'frozen_number', 'marketable_number', 'brand_id', 'category_id', 'published_at'];

    protected $table = 'products';
    protected $casts = ['image' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'name'],
        ];
    }





    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(ProductGallery::class);
    }


    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }



    public function getRouteKeyName(){
        return 'slug';
    }
}