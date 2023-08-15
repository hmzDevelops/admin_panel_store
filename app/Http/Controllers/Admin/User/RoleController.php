<?php

namespace App\Http\Controllers\admin\user;

use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\RoleRequest;
use App\Models\User\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $role = Role::create($inputs);
        $inputs['permissions'] = $inputs['permissions'] ?? [];

        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with('swal-success', 'نقش جدید موفقیت آمیز بود');
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
    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return redirect()->route('admin.user.role.index')->with('swal-success', ' نقش شما با موفقیت ویرایش آمیز بود');
    }


    public function destroy(Role $role)
    {
        $inputs = [];
        foreach ($role->permissions()->get()->toArray() as $permission) {
            $inputs[] = $permission['id'];
        }
        $inputs = $inputs ?? [];
        // dd($inputs);

        $result = $role->permissions()->detach($inputs);

        $role->delete();
        return redirect()->route('admin.user.role.index')->with('swal-success', 'حذف دسته بندی شما با موفقیت ثبت گردید');
    }

    public function permissionForm(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.set-permission', compact('role', 'permissions'));
    }


    public function permissionUpdate(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $inputs['permissions'] = $inputs['permissions'] ?? [];

        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with('swal-success', 'ویرایش دسترسی های نقش انتخابی موفقیت آمیز بود');
    }
}
