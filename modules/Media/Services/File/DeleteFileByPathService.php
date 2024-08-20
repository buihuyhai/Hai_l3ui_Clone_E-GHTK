<?php

namespace Modules\Media\Services\File;

use Exception;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;

class DeleteFileByPathService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(string $path, string $disk = "public")
    {
        try {
            Storage::disk($disk)->delete($path);

            return $this->responseData(true);
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    "message" => $e->getMessage()
                ]
            );
        }
    }

}

