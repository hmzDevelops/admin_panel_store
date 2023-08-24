<?php

namespace App\Models\Market;

use App\Models\Market\CategoryValue;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market\CategoryAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItemSelectedAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "order_item_selected_attributes";

    protected function categoryAttribute(){
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }

    protected function categoryAttributeValue(){
        return $this->belongsTo(CategoryValue::class,'category_value_id');
    }
}
