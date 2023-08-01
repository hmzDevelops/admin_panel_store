<?php

namespace App\Http\Controllers\admin\notify;

use FilesystemIterator;
use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;
use App\Http\Services\Upload\FileService;
use App\Http\Requests\admin\Notify\EmailFileRequest;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Email $email)
    {
        return view('admin.notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();

        if ($request->hasFile('file')) {

            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();

            if ($inputs['file_location'] == 1) {
                $result = $fileService->saveToPublic($request->file('file'));
            } else if ($inputs['file_location'] == 2) {
                $result = $fileService->saveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();
        }

        if (!$result) {
            return redirect()->route('admin.notify.email-file.index', $email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شده است');
        }

        $inputs['public_mail_id'] = $email->id;
        $inputs['file_path'] = $result;
        $inputs['file_size'] = $fileSize;
        $inputs['file_type'] = $fileFormat;

        $file = EmailFile::create($inputs);
        return redirect()->route('admin.notify.email-file.index', $email->id)->with('swal-success', 'فایل جدید شما با موفقیت ثبت گردید');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailFile $file)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailFile $file)
    {
        return view('admin.notify.email-file.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailFileRequest $request,EmailFile $file,FileService $fileService)
    {
        $inputs = $request->all();

        if ($request->hasFile('file')) {

            if(!empty($file->file_path)){

                if ($file->file_location == 1) {
                    $deleteAddress = public_path($file->file_path);
                } else {
                    $deleteAddress = storage_path($file->file_path);
                }
                //delete directory or file
                $fileService->deleteFile($deleteAddress);
            }


            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();

            if ($inputs['file_location'] == 1) {
                $result = $fileService->saveToPublic($request->file('file'));
            } else if ($inputs['file_location'] == 2) {
                $result = $fileService->saveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();

            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;

            if (!$result) {
                return redirect()->route('admin.notify.email-file.index', $file->email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شده است');
            }
        }

        $file->update($inputs);
        return redirect()->route('admin.notify.email-file.index', $file->email->id)->with('swal-success', 'فایل جدید شما با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailFile $file, FileService $fileService)
    {

        //حذف کامل فایلها و پوشه ها در صورتیکه فقط یک فایل موجود باشه

        //find delete location
        if ($file->file_location == 1) {
            $deleteAddress = public_path($file->file_path);
        } else {
            $deleteAddress = storage_path($file->file_path);
        }

        //delete directory or file
        $fileService->deleteFile($deleteAddress);

        $result = $file->delete();
        return redirect()->route('admin.notify.email-file.index', $file->email->id)->with('swal-success', 'فایل مورد نظر شما حذف گردید');
    }



    public function status(EmailFile $file)
    {
        $file->status = $file->status == 0 ? 1 : 0;
        $result = $file->save();

        if ($result) {
            if ($file->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
