<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductMeta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['meta_key','meta_value','product_id'];
    protected $table = 'product_meta';


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
