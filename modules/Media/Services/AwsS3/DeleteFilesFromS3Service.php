<?php

namespace Modules\Media\Services\AwsS3;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;
use Exception;

class DeleteFilesFromS3Service extends BaseService
{
    public function __construct()
    {
    }

    public function handle(array $filePath)
    {
        if (empty($filePath)) return $this->responseData(false);

        try {
            $pathExist = [];
            foreach ($filePath as $item) {
                if (Storage::disk('s3')->exists($item)) {
                    $pathExist[] = $item;
                }
            }

            if (empty($pathExist))
                return $this->responseData(false);

            $response = Storage::disk('s3')->delete($pathExist);

            return $this->responseData($response);
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    'message' => "AWS: {$e->getMessage()}",
                ]
            );
        }

    }

}
