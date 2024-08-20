<?php

namespace Modules\Media\Helpers;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper
{
    const DEFAULT_AVATAR = "avatars/default.png";

    public static function getFileName(UploadedFile $file): string
    {
        $originName = str_replace(' ', '', $file->getClientOriginalName());
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        return $fileName;
    }
}




