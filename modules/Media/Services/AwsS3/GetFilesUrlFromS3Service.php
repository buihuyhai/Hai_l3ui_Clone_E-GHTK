<?php

namespace Modules\Media\Services\AwsS3;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;

class GetFilesUrlFromS3Service extends BaseService
{
    public function __construct()
    {

    }

    public function handle(array $filePath)
    {
        if (empty($filePath)) return $this->responseData(false);

        $pathExist = [];
        foreach ($filePath as $item) {
            if (Storage::disk('s3')->exists($item)) {
                $arrPathExist[] = Storage::disk('s3')->url($item);
            }
        }

        if (empty($arrPathExist))
            return $this->responseData(false);

        return $this->responseData(true, $pathExist);


    }
}
