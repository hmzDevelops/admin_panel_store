<?php

namespace App\Http\Controllers\admin\market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Models\Market\CategoryAttribute;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_attributes = CategoryAttribute::all();
        return view('admin.market.property.index',compact('category_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategorys = ProductCategory::all();
        return view('admin.market.property.create',compact('productCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'unit' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
        ]);

        $inputs = $request->all();
        $category_attribute =  CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', ' فرم جدید شما با موفقیت ثبت گردید');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAttribute $category_attribute)
    {
        $productCategorys = ProductCategory::all();
        return view('admin.market.property.edit',compact('category_attribute','productCategorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CategoryAttribute $category_attribute)
    {
        $validate = $request->validate([
            'name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'unit' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z0-9\ك-ي-ء., ]+$/u',
            'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
        ]);

        $inputs = $request->all();
        $category_attribute->update($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', ' ویرایش فرم  شما با موفقیت ثبت گردید');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $category_attribute)
    {
        $result = $category_attribute->delete();
        return redirect()->route('admin.market.property.index')->with('swal-success', 'فرم مورد نظر شما حذف گردید');
    }
}
