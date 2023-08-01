<?php

namespace App\Http\Controllers\admin\notify;

use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\notify\EmailRequest;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.notify.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notify.email.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailRequest $request)
    {
        $inputs = $request->all();

        // date fix
        $timeStamp = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);

        $email = Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل جدید شما با موفقیت ثبت گردید');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();

        // date fix
        $timeStamp = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);

        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        $result = $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل مورد نظر شما حذف گردید');
    }

    public function status(Email $email)
    {
        $email->status = $email->status == 0 ? 1 : 0;
        $result = $email->save();

        if ($result) {
            if ($email->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
