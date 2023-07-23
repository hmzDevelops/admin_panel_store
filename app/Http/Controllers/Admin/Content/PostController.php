<?php

namespace App\Http\Controllers\admin\content;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postCategorys = PostCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.content.post.create', compact('postCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, ImageService $imageService)
    {

        // dd($request->all());

        $inputs = $request->all();

        // date fix
        $timeStamp = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);

        if ($request->hasFile('image')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.post.index')->with('toast-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }



        $inputs['auther_id'] = 1;
        $post = Post::create($inputs);
        return redirect()->route('admin.content.post.index')->with('toast-success', 'پست جدید شما با موفقیت ثبت گردید');
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
    public function edit(Post $post)
    {
        $postCategorys = PostCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.content.post.edit', compact(['post','postCategorys']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        $inputs = $request->all();

        // date fix
        if(isset($request->published_at)){
            $timeStamp = substr($request->published_at,0,10);
            $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);
        }

        if ($request->hasFile('image')) {

            //delete old image
            if (!empty($post->image)) {
                $result = $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if (!$result) {
                return redirect()->route('admin.content.post.index')->with('toast-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($post->image)){

                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $post->update($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست  مورد نظر شما حذف گردید');;;
    }


    public function status(Post $post)
    {

        $post->status = $post->status == 0 ? 1 : 0;
        $result = $post->save();


        if ($result) {
            if ($post->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function commentable(Post $post)
    {

        $post->commentable = $post->commentable == 0 ? 1 : 0;
        $result = $post->save();


        if ($result) {
            if ($post->commentable == 0) {
                return response()->json(['commentable' => true, 'checked' => false]);
            } else {
                return response()->json(['commentable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['commentable' => false]);
        }
    }
}
