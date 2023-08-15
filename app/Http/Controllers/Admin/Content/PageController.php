<?php

namespace App\Http\Controllers\admin\content;

use App\Models\Content\Page;
use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\content\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::orderBy('created_at', 'DESC')->simplePaginate(5);
        //  $postCategorys = PostCategoryCache::all('created_at');

        return view('admin.content.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $inputs = $request->all();

        $inputs['slug'] = null;
        $post = Page::create($inputs);
        return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه جدید شما با موفقیت ثبت گردید');
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
    public function edit(Page $page)
    {
        return view('admin.content.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();

        $inputs['slug'] = null;
        $page->update($inputs);
        return redirect()->route('admin.content.page.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $result = $page->delete();
        return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه مورد نظر شما حذف گردید');
    }

    public function status(Page $page)
    {
        $page->status = $page->status == 0 ? 1 : 0;
        $result = $page->save();

        if ($result) {
            if ($page->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
