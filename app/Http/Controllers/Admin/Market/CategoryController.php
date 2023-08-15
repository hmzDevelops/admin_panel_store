<?php

namespace App\Http\Controllers\admin\market;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use Intervention\Image\Facades\Image;
use App\Models\Market\ProductCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Services\Image\ImageCacheService;
use App\Http\Requests\admin\Market\ProductCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategorys = ProductCategory::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.market.category.index', compact('productCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('parent_id', null)->get();
        return view('admin.market.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
        }

        if (!$result) {
            return redirect()->route('admin.market.category.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
        }

        $inputs['image'] = $result;
        $productCategory = ProductCategory::create($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت گردید');
    }


    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        $parent_categories = ProductCategory::where('parent_id', null)->get()->except($productCategory->id);
        return view('admin.market.category.edit', compact('productCategory', 'parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory, ImageService $imageService)
    {
        $inputs = $request->all();


        if ($request->hasFile('image')) {

            //delete old image
            if (!empty($productCategory->image)) {
                $result = $imageService->deleteDirectoryAndFiles($productCategory->image['directory']);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($productCategory->image)){

                $image = $productCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $productCategory->update($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $result = $productCategory->delete();
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی مورد نظر شما حذف گردید');
    }



    public function status(ProductCategory $productCategory)
    {
        $productCategory->status = $productCategory->status == 0 ? 1 : 0;
        $result = $productCategory->save();

        if ($result) {
            if ($productCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
