<?php

namespace Modules\Media\Services\AwsS3;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;
use Exception;

class DeleteFileFromS3Service extends BaseService
{
    public function __construct()
    {
    }

    public function handle(string $filePath)
    {
        if (!$filePath) return $this->responseData(false);

        try {
            if (!(Storage::disk('s3')->exists($filePath)))
                return $this->responseData(false);

            $result = Storage::disk('s3')->delete($filePath);

            if (!$result)
                return $this->responseData(false);

            return $this->responseData(true);

        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    'message' => "AWS: {$e->getMessage()}",
                ]
            );
        }

    }


}
