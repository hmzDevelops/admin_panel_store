<?php

namespace App\Models\Market;

use App\Models\User;
use App\Models\Market\Product;
use App\Models\Market\Guarantee;
use App\Models\Market\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "cart_items";
    protected $fillable = ['product_id', 'user_id', 'color_id', 'guarantee_id', 'number', 'status'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    // قمیت محصول + قمیت رنگ + قیمت گارانتی
    public function cartItemProductPrice()
    {
        $guaranteePriceIncrease = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->color->price_increase;

        return $guaranteePriceIncrease + $colorPriceIncrease + $this->product->price;
    }


    // محاسبه تخفیف
    public function cartItemProductDiscount()
    {

        $productDiscount = empty($this->product->activeAmazingSales()) ? 0 : $this->product->price * ($this->product->activeAmazingSales()->percentage / 100);

        return $productDiscount;
    }

    // محاسبه تعداد خرید
    public function cartItemFinalPrice()
    {
        $cartItemProductPrice = $this->cartItemProductPrice();
        $productDiscount = $this->cartItemProductDiscount();

        return $this->number * ($cartItemProductPrice - $productDiscount);
    }

    public function cartItemFinalDiscount()
    {
        $productDiscount = $this->cartItemProductDiscount();
        return $this->number * $productDiscount;
    }
}
