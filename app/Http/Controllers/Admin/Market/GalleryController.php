<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductGallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, Request $request, ImageService $imageService)
    {
        $validate = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);

        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.market.gallery.index', $product)->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }
        }

        $inputs['image'] = $result;
        $inputs['product_id'] = $product->id;
        $result = ProductGallery::create($inputs);
        return redirect()->route('admin.market.gallery.index', $product)->with('swal-success', ' تصویر جدید شما با موفقیت ثبت گردید');
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
    public function destroy(Product $product, ProductGallery $productGallery)
    {
        $result = $productGallery->delete();
        return redirect()->route('admin.market.gallery.index', $product)->with('swal-success', 'تصویر مورد نظر شما حذف گردید');
    }
}
