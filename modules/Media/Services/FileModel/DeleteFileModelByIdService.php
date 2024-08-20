<?php

namespace Modules\Media\Services\FileModel;

use Modules\Core\Services\BaseService;
use Modules\Media\Models\MediaFile;
use Modules\Media\Services\File\DeleteFileByPathService;

class DeleteFileModelByIdService extends BaseService
{
    protected DeleteFileByPathService $deleteFileByPathService;

    public function __construct(DeleteFileByPathService $deleteFileByPathService)
    {
        $this->deleteFileByPathService = $deleteFileByPathService;
    }

    public function handle(int $id, string $disk = "public")
    {
        $file = MediaFile::find($id);

        if (!$file) return $this->responseData(false);

        $response = $this->deleteFileByPathService->handle($file->file_path, $disk);

        if (!$response['status']) return $this->responseData(false);

        return $this->responseData($file->delete());
    }

}

