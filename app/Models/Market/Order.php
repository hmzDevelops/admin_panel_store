<?php

namespace App\Models\Market;

use App\Models\User;
use App\Models\Market\Copan;
use App\Models\Market\Address;
use App\Models\Market\Payment;
use App\Models\Market\Delivery;
use App\Models\Market\OrderItem;
use App\Models\Market\CommonDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order_final_amount', 'delivery_status'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class);
    }


    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    //payment_status_value
    public function getPaymentStatusValueAttribute()
    {

        switch ($this->payment_status) {
            case 0:
                return "پرداخت نشده";
                break;
            case 1:
                return "پرداخت شده";
                break;
            case 2:
                return "باطل شده";
                break;
            default:
                return "برگشت داده شده";
                break;
        }
    }

    //delivery_status_value
    public function getDeliveryStatusValueAttribute()
    {
        switch ($this->delivery_status) {
            case 0:
                return "ارسال نشده";
                break;
            case 1:
                return "در حال ارسال";
                break;
            case 2:
                return "ارسال شده";
                break;
            default:
                return "تحویل شده";
                break;
        }
    }

    //order_type_value
    public function getOrderStatusValueAttribute()
    {

        switch ($this->order_status) {
            case 1:
                return "در انتظار تائید";
                break;
            case 2:
                return "تائید نشده";
                break;
            case 3:
                return "تائید شده";
                break;

            case 4:
                return "باطل شده";
                break;

            case 5:
                return "مرجوع شده";
                break;

            default:
                return "بررسی نشده";
                break;
        }
    }

    //payment_type_value
    public function getPaymentTypeValueAttribute()
    {
        switch ($this->payment_type) {
            case 0:
                return "آنلاین";
                break;
            case 1:
                return "آفلاین";
                break;
            default:
                return "در محل";
                break;
        }
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
