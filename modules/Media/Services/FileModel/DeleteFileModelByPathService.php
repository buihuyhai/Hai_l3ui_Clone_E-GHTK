<?php

namespace Modules\Media\Services\FileModel;

use Illuminate\Support\Facades\DB;
use Modules\Core\Services\BaseService;
use Modules\Media\Models\MediaFile;
use Modules\Media\Services\File\DeleteFileByPathService;
use Exception;

class DeleteFileModelByPathService extends BaseService
{
    protected DeleteFileByPathService $deleteFileByPathService;

    public function __construct(DeleteFileByPathService $deleteFileByPathService)
    {
        $this->deleteFileByPathService = $deleteFileByPathService;
    }

    public function handle(string $path, $disk = "public"): array
    {
        try {

            if (!$path) return $this->responseData(false);

            $file = MediaFile::where('path', $path)->firstOrFail();

            if (!$file) return $this->responseData(false);

            $response = $this->deleteFileByPathService->handle($path, $disk);

            if (!$response['status']) return $this->responseData(false);

            return $this->responseData($file->delete());

        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }

}
