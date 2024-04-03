<?php

namespace App\Services;

use App\Interfaces\FileInterface;
use Illuminate\Support\Facades\Storage;

class FileService implements FileInterface
{
    /**
     * Upload resource.
     *
     * @param $file
     * @param $filePath
     * @return string
     */
    public static function uploadFile($file, $filePath)
    {
        $fileName = $filePath . DIRECTORY_SEPARATOR . rand() . time() . "." . $file->getClientOriginalExtension();
        self::setFile($fileName, file_get_contents($file));
        return $fileName;
    }

    /**
     * Set resource.
     *
     * @param $fileName
     * @param $file
     * @return bool
     */
    public static function setFile($fileName, $file)
    {
        return Storage::put($fileName, $file);
    }

    /**
     * Delete resource.
     *
     * @param $fileName
     * @return void
     */
    public static function deleteFile($fileName)
    {
        if (Storage::exists($fileName)) {
            Storage::delete($fileName);
        }
    }
}
