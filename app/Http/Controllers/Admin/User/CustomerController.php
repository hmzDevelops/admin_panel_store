<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withTrashed()
            ->where('user_type', 0)
            ->get();
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if (!$result) {
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['user_type'] = 0;
        $inputs['password'] = Hash::make($request->password);
        $user = User::create($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', ' مشتری جدید شما با موفقیت ثبت گردید');
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
    public function edit(User $user)
    {
        return view('admin.user.customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, ImageService $imageService, User $user)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {

            //delete old image
            if (!empty($user->profile_photo_path)) {
                $result = $imageService->deleteImage($user->profile_photo_path);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));


            if (!$result) {
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }



        $user->update($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $result = User::where(['deleted_at' =>  null, 'id' => $id])->count();

        if ($result == 0) {
            User::withTrashed()->find($id)->restore();
            return redirect()->route('admin.user.customer.index')->with('swal-success', 'مشتری  مورد نظر شما  بازیابی شد');
        } else {
            $result = User::find($id)->delete();
            return redirect()->route('admin.user.customer.index')->with('swal-success', 'مشتری  مورد نظر شما حذف گردید');
        }
    }


    public function changeActive(User $user)
    {
        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();

        if ($result) {
            if ($user->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }

    public function status(User $user)
    {
        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();

        if ($result) {
            if ($user->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
