<?php

namespace Modules\Media\Services\FileModel;

use Modules\Core\Services\BaseService;
use Modules\Media\Models\MediaFile;

class CreateFileModelService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(array $data)
    {
        $file = MediaFile::create($data);

        if (!$file)
            return $this->responseData(false);

        return $this->responseData(true, $file);
    }

}

