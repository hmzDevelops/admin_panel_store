<?php

namespace App\Http\Controllers\admin\market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductColor;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.color.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.color.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, Request $request)
    {
        $validate = $request->validate([
            'color_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'price_increase' => 'required|numeric',
        ]);

        $inputs = $request->all();
        $inputs['product_id'] = $product->id;

        $color =  ProductColor::create($inputs);

        return redirect()->route('admin.market.color.index', $product)->with('swal-success', ' رنگ جدید شما با موفقیت ثبت گردید');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductColor $productColor)
    {
        $result = $productColor->delete();
        return redirect()->route('admin.market.color.index', $product)->with('swal-success', 'رنگ مورد نظر شما حذف گردید');
    }
}
