<?php

namespace App\Http\Controllers\admin\content;

use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\content\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.content.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->seen = 1;
        $comment->save();
        return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
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
    public function destroy(string $id)
    {
        //
    }

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            if ($comment->approved == 0) {
                return response()->json(['approved' => false]);
            } else {
                return response()->json(['approved' => true]);
            }
        } else {
            return response()->json(['approved' => false]);
        }
    }


    public function answer(CommentRequest $request, Comment $comment)
    {

        $inputs = $request->all();

        $inputs['auther_id'] = 2;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        $inputs['seen'] = 1;


        $comment = Comment::create($inputs);
        return redirect()->route('admin.content.comment.index')->with('toast-success', 'پاسخ شما با موفقیت ثبت گردید');
    }
}
