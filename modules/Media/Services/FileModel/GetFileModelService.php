<?php

namespace Modules\Media\Services\FileModel;

use Modules\Core\Services\BaseService;
use Modules\Media\Models\MediaFile;
use Illuminate\Database\Eloquent\Collection;

class GetFileModelService extends BaseService
{
    public function __construct()
    {
    }

    public function getAllFileModel(): Collection
    {
        return MediaFile::all();
    }

    public function getFileModelById(int $id): array
    {
        $fileModel = MediaFile::find($id);

        if (!$fileModel)
            return $this->responseData(false);

        return $this->responseData(true, $fileModel);
    }

    public function getFileModelByPath(string $path): array
    {
        $fileModel = MediaFile::where('file_path', $path)->first();

        if (!$fileModel)
            return $this->responseData(false);

        return $this->responseData(true, $fileModel);
    }

}
