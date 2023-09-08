<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.market.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
        }

        if (!$result) {
            return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
        }

        $inputs['logo'] = $result;
        $brand = Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', ' برند جدید شما با موفقیت ثبت گردید');

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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();


        if ($request->hasFile('logo')) {

            //delete old image
            if (!empty($brand->image)) {
                $result = $imageService->deleteDirectoryAndFiles($brand->image['directory']);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));

            if (!$result) {
                return redirect()->route('admin.content.brand.index')->with('toast-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['logo'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($brand->image)){

                $image = $brand->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['logo'] = $image;
            }
        }


        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $result = $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند  مورد نظر شما حذف گردید');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();

        if ($result) {
            if ($brand->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
