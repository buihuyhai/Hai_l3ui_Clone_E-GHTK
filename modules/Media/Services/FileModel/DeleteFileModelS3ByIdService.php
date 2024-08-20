<?php

namespace Modules\Media\Services\FileModel;

use Modules\Core\Services\BaseService;
use Modules\Media\Models\MediaFile;
use Modules\Media\Services\AwsS3\DeleteFileFromS3Service;

class DeleteFileModelS3ByIdService extends BaseService
{
    protected DeleteFileFromS3Service $deleteFileFromS3Service;

    public function __construct(DeleteFileFromS3Service $deleteFileFromS3Service)
    {
        $this->deleteFileFromS3Service = $deleteFileFromS3Service;
    }

    public function handle(int $id): array
    {
        if (!$id) return $this->responseData(false);

        $file = MediaFile::find($id);

        $response = $this->deleteFileFromS3Service->handle($file->file_path);

        if (!$response['status'])
            return $this->responseData(false);

        return $this->responseData($file->delete());
    }

}

