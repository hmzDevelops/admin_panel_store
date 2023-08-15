<?php

namespace App\Http\Controllers\admin\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Services\Upload\FileService;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\admin\User\AdminUserRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::withTrashed()
            ->where('user_type', 1)
            ->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if (!$result) {
                return redirect()->route('admin.user.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['user_type'] = 1;
        $inputs['password'] = Hash::make($request->password);
        $user = User::create($inputs);
        return redirect()->route('admin.user.index')->with('swal-success', ' ادمین جدید شما با موفقیت ثبت گردید');
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
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserRequest $request, ImageService $imageService, User $admin)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {

            //delete old image
            if (!empty($admin->profile_photo_path)) {
                $result = $imageService->deleteImage($admin->profile_photo_path);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));


            if (!$result) {
                return redirect()->route('admin.user.index')->with('swal-error', 'آپلود تصویر دچار مشکل شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }



        $admin->update($inputs);
        return redirect()->route('admin.user.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {

        $result = $admin->delete();
        return redirect()->route('admin.user.index')->with('swal-success', 'ادمین  مورد نظر شما حذف گردید');
    }

    public function changeActive(User $admin)
    {
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();

        if ($result) {
            if ($admin->activation == 0) {
                return response()->json(['activation' => true, 'checked' => false]);
            } else {
                return response()->json(['activation' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['activation' => false]);
        }
    }

    public function status(User $admin)
    {
        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();

        if ($result) {
            if ($admin->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function softDelete(User $admin)
    {




        // if (isset($_POST['value']) && $_POST['value'] == "undelete") {
        //     User::withTrashed()->find($user->id)->update(['deleted_at' => null]);
        //     return redirect()->route('admin.user.index')->with('swal-success', 'ادمین  مورد نظر شما از حال حذف خارج شد');
        // } else {
        //     $result = $user->delete();
        //     return redirect()->route('admin.user.index')->with('swal-success', 'ادمین  مورد نظر شما حذف گردید');
        // }
    }
}
