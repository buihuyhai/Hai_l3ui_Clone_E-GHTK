<?php

namespace Modules\Media\Services\File;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;
use Modules\Media\Helpers\FileHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(
        UploadedFile $file,
        string       $asset = 'assets',
        string       $dir = 'Media',
        string       $disk = 'public'
    ): array
    {
        if (!$file) return $this->responseData(false);

        $fileName = FileHelper::getFileName($file);
        $path = "$asset/$dir/$fileName";
        Storage::disk($disk)->put($path, file_get_contents($file), $disk);
        return $this->responseData(true,
            [
                'file_name' => $fileName,
                'file_path' => $path,
                'url'       => Storage::disk($disk)->url($path),
            ]
        );
    }
}

