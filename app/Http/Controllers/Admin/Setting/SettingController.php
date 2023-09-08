<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\DB;
use Database\Seeders\SettingSeeder;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Setting\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting == null) {
            $defulat = new SettingSeeder();
            $defulat->run();
            $setting = Setting::first();
        }
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('logo')) {

            //delete old image
            if (!empty($setting->logo)) {
                $result = $imageService->deleteDirectoryAndFiles($setting->logo);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('logo');
            $result = $imageService->save($request->file('logo'));

            if (!$result) {
                return redirect()->route('admin.setting.index')->with('toast-error', 'آپلود لوگو دچار مشکل شد!');
            }

            $inputs['logo'] = $result;
        }

        if ($request->hasFile('icon')) {

            //delete old image
            if (!empty($setting->icon)) {
                $result = $imageService->deleteDirectoryAndFiles($setting->logo);
            }

            //save new image
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->file('icon'));

            if (!$result) {
                return redirect()->route('admin.setting.index')->with('toast-error', 'آپلود آیکون دچار مشکل شد!');
            }

            $inputs['icon'] = $result;
        }

        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', 'ویرایش موفقیت آمیز بود');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function refreshDB()
    {
        $tableNames = DB::select('SHOW TABLES');
        return view('admin.setting.tables', compact('tableNames'));
    }




    public function resetAutoIncrement(Request $request)
    {

        $messages = [
            'table.required' => 'فیلد  نام جدول اجبار است',
        ];

        $validateData = $request->validate([
            'table' => 'required|max:50',
        ], $messages);


        $table = $request['table'];
        DB::statement("ALTER TABLE $table AUTO_INCREMENT = 0");
        return redirect()->route('admin.setting.refresh')->with('toast-success', 'جدول مورد نظر شما رفرش شد');



    }
}
