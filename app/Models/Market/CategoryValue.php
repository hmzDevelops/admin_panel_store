<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['product_id', 'category_attribute_id','value','type'];
    protected $table = 'category_values';
    // protected $casts = ['type' => 'array'];


    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


   
}
