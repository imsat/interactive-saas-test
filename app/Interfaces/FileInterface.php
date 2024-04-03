<?php

namespace App\Interfaces;

interface FileInterface
{
    public static function uploadFile($file, $filePath);

    public static function setFile($fileName, $file);

    public static function deleteFile($fileName);
}
