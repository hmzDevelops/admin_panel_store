<?php

namespace App\Http\Controllers\admin\content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use Intervention\Image\Facades\Image;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use Facades\App\Http\Services\Cache\PostCategoryCache;
use App\Http\Services\Image\ImageCacheService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postCategorys = PostCategory::orderBy('created_at', 'DESC')->simplePaginate(5);
        //  $postCategorys = PostCategoryCache::all('created_at');

        return view('admin.content.category.index', compact('postCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $imgCache = new ImageCacheService();
        // return $imgCache->cache('public/1.png');

        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            // $result = $imageService->save($request['image']);
            // $result = $imageService->fitAndSave($request->file('image'), 800,600);

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
        }

        if (!$result) {
            return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
        }

        $inputs['image'] = $result;
        $postCategory = PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت گردید');
    }


    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {

        return view('admin.content.category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)
    {
        $inputs = $request->all();


        if ($request->hasFile('image')) {

            //delete old image
            if (!empty($postCategory->image)) {
                $result = $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($postCategory->image)){

                $image = $postCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        $result = $postCategory->delete();
        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی مورد نظر شما حذف گردید');
    }

    public function status(PostCategory $postCategory)
    {
        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();

        if ($result) {
            if ($postCategory->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
