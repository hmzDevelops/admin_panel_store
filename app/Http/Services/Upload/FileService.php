<?php

namespace App\Http\Services\Upload;

use App\Http\Services\Upload\FileToolsService;

class FileService extends FileToolsService
{

    public function saveToPublic($file)
    {
        //set image
        $this->setFile($file);
        //execute provider
        $this->provider();
        //save image
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }


    public function saveToStorage($file)
    {
        //set image
        $this->setFile($file);
        //execute provider
        $this->provider();
        //save image
        $result = $file->move(storage_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }


    public function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }


    public function deleteDirectoryAndFiles($directory)
    {
        if (!is_dir($directory)) {
            return false;
        }

        $files = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDirectoryAndFiles($file);
            } else {
                unlink($file);
            }
        }
        $result = rmdir($directory);
        return $result;
    }

}
