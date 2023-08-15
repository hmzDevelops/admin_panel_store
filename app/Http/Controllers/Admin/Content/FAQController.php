<?php

namespace App\Http\Controllers\admin\content;

use App\Models\Content\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\admin\content\FAQRequest;
use App\Http\Services\Image\ImageToolsService;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $faqs = FAQ::orderBy('created_at', 'DESC')->simplePaginate(5);
        //  $postCategorys = PostCategoryCache::all('created_at');
        return view('admin.content.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {
        $inputs = $request->all();

        $faq = FAQ::create($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', ' سوال جدید با موفقیت ثبت گردید');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $faqs = FAQ::where('id', 3)->get();
        return view('admin.content.faq.show', compact('faqs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        $inputs = $request->all();

        $faq->update($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $result = $faq->delete();
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'سوال مورد نظر شما حذف گردید');
    }


    public function status(FAQ $faq)
    {
        $faq->status = $faq->status == 0 ? 1 : 0;
        $result = $faq->save();

        if ($result) {
            if ($faq->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function upload(Request $request, ImageService $imageService)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            // $request->file('upload')->move(public_path('uploads'), $filenametostore);

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'faq');
            $result = $imageService->save($request->file('upload'));

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($result);

            $url = str_replace('\\','/',$url);

            $msg = 'با موفقیت بارگذاری گردید';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html;');
            echo $re;
        }
    }
}
