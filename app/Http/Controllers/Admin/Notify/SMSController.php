<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\SMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sms = SMS::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.notify.sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notify.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SMSRequest $request)
    {

        $inputs = $request->all();

        // date fix
        $timeStamp = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);

        $sms = SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک جدید شما با موفقیت ثبت گردید');
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
    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();

        // date fix
        $timeStamp = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$timeStamp);

        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMS $sms)
    {
        $result = $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک مورد نظر شما حذف گردید');
    }

    public function status(SMS $sms)
    {
        $sms->status = $sms->status == 0 ? 1 : 0;
        $result = $sms->save();

        if ($result) {
            if ($sms->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
