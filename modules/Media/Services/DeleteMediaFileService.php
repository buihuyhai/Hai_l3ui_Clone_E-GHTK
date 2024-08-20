<?php

namespace Modules\Media\Services;

use Modules\Core\Services\BaseService;
use Modules\Media\Services\FileModel\DeleteFileModelByIdService;
use Modules\Media\Services\FileModel\DeleteFileModelByPathService;

class DeleteMediaFileService extends BaseService
{
    protected DeleteFileModelByPathService $deleteFileModelByPathService;
    protected DeleteFileModelByIdService $deleteFileModelByIdService;

    public function __construct(
        DeleteFileModelByPathService $deleteFileModelByPathService,
        DeleteFileModelByIdService   $deleteFileModelByIdService
    )
    {
        $this->deleteFileModelByPathService = $deleteFileModelByPathService;
        $this->deleteFileModelByIdService = $deleteFileModelByIdService;
    }

    public function handle(string|int $payload)
    {
        if (!$payload)
            return $this->responseData(false);

        if (is_int($payload))
            $response = $this->deleteFileModelByIdService->handle($payload);

        if (is_string($payload))
            $response = $this->deleteFileModelByPathService->handle($payload);

        if (!isset($response) || !$response['status'])
            return $this->responseData(false);

        return $this->responseData(true, $response['data']);
    }


}
