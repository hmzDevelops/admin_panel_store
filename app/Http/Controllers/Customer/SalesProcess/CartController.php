<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        if(Auth::check()){

            $cartItems = CartItem::where('user_id', auth()->user()->id)->get();
            $relatedProducts = Product::all();

            return view('customer.sales-process.cart', compact('cartItems','relatedProducts'));

        }else{
            return redirect()->route('auth.customer.login-register-form');
        }
    }

    public function updateCart()
    {
    }

    public function addToCart(Product $product, Request $request)
    {


        $messages = [
            'number.required' => 'تعدادی وارد نشده است',
            'number.min' => 'حداقل تعداد وارد شده صحیح نیست',
            'number.max' => 'حداکثر تعداد وارد شده صحیح نیست',
        ];

        if (Auth::check()) {

            $request->validate([
                'color' => 'exists:product_colors,id',
                'guarantee' => 'exists:guarantees,id',
                'number' => 'numeric|min:1|max:5'
            ], $messages);

            $cartItems = CartItem::where('product_id', $product->id)->where('user_id', auth()->user()->id)->get();

            foreach($cartItems as $cartItem){

                // اگر رنگ و گارانتی محصول مورد سفارش با سفارش ثبت شده قبلی یکی باشد
                if($cartItem->color_id == $request->color && $cartItem->guarantee_id == $request->guarantee){

                    //اگر تعداد درخواست سفارش با سفارش قبلی همین کالا یکی نباشد سفارش جدید ثبت می شود
                    if($cartItem->number != $request->number){
                        $cartItem->update(['number' => $request->number]);
                        return response()->json(['status' => 2]);
                    }else{

                        //در غیر اینصورت باید به صفحه سفارشات برگردد
                        return response()->json(['status' => 0]);

                    }

                }
            }


            $inputs = [];

            $inputs['color_id'] = $request->color ?? null;
            $inputs['guarantee_id'] = $request->guarantee ?? null;
            $inputs['user_id'] = auth()->user()->id;
            $inputs['product_id'] = $product->id;

            CartItem::create($inputs);
            return response()->json(['status' => 1]);

        } else {
        }
    }

    public function removeFromCart(CartItem $cartItem)
    {
        if($cartItem->user_id === Auth::user()->id){
              $result = $cartItem->delete();
        }

        return $result;
    }
}
