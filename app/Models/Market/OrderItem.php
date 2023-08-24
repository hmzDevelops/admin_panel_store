<?php

namespace App\Models\Market;

use App\Models\Market\Order;
use App\Models\Market\Product;
use App\Models\Market\Guarantee;
use App\Models\Market\AmazingSale;
use App\Models\Market\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Market\OrderItemSelectedAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "order_items";

    public function orderItems()
    {
        return $this->belongsTo(Order::class);
    }


    public function singleProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function amazingSale()
    {
        return $this->belongsTo(AmazingSale::class, 'amazing_sale_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class, 'guarantee_id');
    }

    public function orderItemAttributes()
    {
        return $this->hasMany(OrderItemSelectedAttribute::class, 'order_item_id', 'id');
    }
}
