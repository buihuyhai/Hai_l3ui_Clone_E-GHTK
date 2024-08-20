<?php

namespace Modules\Media\Services\AwsS3;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;

class GetFileUrlFromS3Service extends BaseService
{
    public function __construct()
    {

    }

    public function handle(string $filePath)
    {
        if (!$filePath) return $this->responseData(false);

        if (!Storage::disk('s3')->exists($filePath))
            return $this->responseData(false);

        return $this->responseData(true, [
            'url' => Storage::disk('s3')->url($filePath),
        ]);

    }
}
