<?php

namespace App\Models\Market;

use App\Models\Market\Payment;
use App\Models\Market\Delivery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order_final_amount','delivery_status'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    //قالب بندی نمایش اعداد بصورت سه رقم سه رقم
    public function getOrderFinalAmountFormattedAttribute()
    {
        return number_format($this->order_final_amount, 0, '.', ',');
    }

    public function getOrderDiscountAmountFormattedAttribute()
    {
        return number_format($this->order_discount_amount, 0, '.', ',');
    }

    public function getOrderTotalProductsDiscountAmountFormattedAttribute()
    {
        return number_format($this->order_total_products_discount_amount, 0, '.', ',');
    }


    public function getOrderTotalFinalFormattedAttribute()
    {
        $total = $this->order_final_amount - $this->order_discount_amount;
        return number_format($total, 0, '.', ',');
    }
}
