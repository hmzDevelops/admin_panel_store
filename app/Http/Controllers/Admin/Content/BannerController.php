<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Content\Banner;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\BannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'DESC')->simplePaginate(5);
        $positions = Banner::$positions;
        return view('admin.content.banner.index', compact('banners','positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.banner.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }

        $inputs['auther_id'] = 2;
        $banner = Banner::create($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success', 'بنر جدید شما با موفقیت ثبت گردید');

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
    public function edit(Banner $banner)
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.edit', compact('banner', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, ImageService $imageService, Banner $banner)
    {

        $inputs = $request->all();

        if ($request->hasFile('image')) {

            //delete old image
            if (!empty($banner->image)) {
                $result = $imageService->deleteImage($banner->image);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.banner.index')->with('toast-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($banner->image)){

                $image = $banner->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }



        $banner->update($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $result = $banner->delete();
        return redirect()->route('admin.content.banner.index')->with('swal-success', 'بنر  مورد نظر شما حذف گردید');;;
    }

    public function status(Banner $banner)
    {

        $banner->status = $banner->status == 0 ? 1 : 0;
        $result = $banner->save();


        if ($result) {
            if ($banner->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
