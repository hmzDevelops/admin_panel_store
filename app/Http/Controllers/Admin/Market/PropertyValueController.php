<?php

namespace App\Http\Controllers\admin\market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\CategoryValue;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\admin\Market\CategoryValueRequest;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $category_attribute)
    {
        return view('admin.market.property.value.index', compact('category_attribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryAttribute $category_attribute)
    {
        return view('admin.market.property.value.create', compact('category_attribute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryValueRequest $request, CategoryAttribute $category_attribute)
    {

        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $category_attribute->id;
        $value =  CategoryValue::create($inputs);
        return redirect()->route('admin.market.value.index', $category_attribute)->with('swal-success', ' مقدار فرم کالای جدید شما با موفقیت ثبت گردید');
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
    public function edit(CategoryAttribute $category_attribute, CategoryValue $value)
    {
        return view('admin.market.property.value.edit', compact('category_attribute', 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryValueRequest $request, CategoryAttribute $category_attribute, CategoryValue $value)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $category_attribute->id;
        $value->update($inputs);
        return redirect()->route('admin.market.value.index', $category_attribute)->with('swal-success', ' ویرایش مقدار فرم کالای جدید شما با موفقیت ثبت گردید');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $category_attribute, CategoryValue $value)
    {
        $result = $value->delete();
        return redirect()->route('admin.market.value.index', $category_attribute)->with('swal-success', 'مقدار فرم مورد نظر شما حذف گردید');
    }
}
