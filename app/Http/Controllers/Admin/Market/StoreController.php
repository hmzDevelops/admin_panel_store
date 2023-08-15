<?php

namespace App\Http\Controllers\admin\market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Market\StoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.market.store.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addTostore(Product $product)
    {
        return view('admin.market.store.add-to-store',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Product $product)
    {
        $product->marketable_number += $request->marketable_number;
        $product->save();
        Log::info("reciver => {$request->reciver}, deliver => {$request->deliver},description => {$request->description}, add => {$request->marketable_number}");
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی جدید شما با موفقیت آمیز بود');
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
    public function edit(Product $product)
    {
        return view('admin.market.store.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Product $product)
    {
        $inputs = $request->all();
        $product->update($inputs);
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی جدید شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
