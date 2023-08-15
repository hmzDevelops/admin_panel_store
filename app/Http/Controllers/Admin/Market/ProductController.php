<?php

namespace App\Http\Controllers\admin\market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\admin\Market\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create', compact('productCategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        // dd($request->all());
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
        }

        if (!$result) {
            return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
        }

        $inputs['image'] = $result;
        $inputs['slug'] = null;
        //دستور فوق جهت اجرای همزمان دو درخواست است و اگر یکی خطا داشته باشد دیگری اجرا نخواهد شد
        DB::transaction(function () use ($inputs, $request) {
            $product = Product::create($inputs);

            $metas = array_combine($request->meta_key, $request->meta_value);

            foreach ($metas as $key => $value) {
                $meta =  ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
            }
        });

        return redirect()->route('admin.market.product.index')->with('swal-success', ' محصول جدید شما با موفقیت ثبت گردید');
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
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit', compact('productCategories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, ImageService $imageService, Product $product)
    {
        //  dd($request->all());
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if ($request->hasFile('image')) {

            //delete old image
            if (!empty($product->image)) {
                $result = $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }

        $inputs['slug'] = null;
        $product->update($inputs);

        if ($request->meta_key != null) {

            $meta_keys = $request->meta_key;
            $meta_values = $request->meta_value;
            $meta_ids = array_keys($request->meta_value);

            $metas = array_map(function ($meta_id, $meta_key, $meta_value) {
                return array_combine(
                    ['meta_id', 'meta_key', 'meta_value'],
                    [$meta_id, $meta_key, $meta_value],
                );
            }, $meta_ids, $meta_keys, $meta_values);

            foreach ($metas as $meta) {
                ProductMeta::where('id', $meta['meta_id'])->update([
                    'meta_key' => $meta['meta_key'],
                    'meta_value' => $meta['meta_value'],
                ]);
            }
        }

        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول شما با موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $result = $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول مورد نظر شما حذف گردید');
    }
}
