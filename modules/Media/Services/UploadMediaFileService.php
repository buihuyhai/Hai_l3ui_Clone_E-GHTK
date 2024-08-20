<?php

namespace Modules\Media\Services;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\BaseService;
use Modules\Media\Services\File\UploadFileService;
use Modules\Media\Services\FileModel\CreateFileModelService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadMediaFileService extends BaseService
{
    protected UploadFileService $uploadFileService;
    protected CreateFileModelService $createFileModelService;

    public function __construct(
        UploadFileService      $uploadFileService,
        CreateFileModelService $createFileModelService
    )
    {
        $this->uploadFileService = $uploadFileService;
        $this->createFileModelService = $createFileModelService;
    }

    public function upload(
        UploadedFile $file,
        string       $asset = 'assets',
        string       $dir = 'Media',
        string       $disk = 'public'): array
    {
        $response = $this->uploadFileService->handle($file, $asset, $dir, $disk);

        if (!$response['status'])
            return $this->responseData(false);

        $data = $response['data'];
        $mediaFileResponse = $this->createFileModelService->handle([
            "file_name"      => $data["file_name"],
            "file_path"      => $data["file_path"],
            "url"            => $data["url"],
            "file_size"      => $file->getSize(),
            "file_type"      => $file->getType(),
            "file_extension" => $file->getClientOriginalExtension(),
        ]);

        if (!$mediaFileResponse['status']) {
            Storage::disk($disk)->delete($data['file_path']);
            return $this->responseData(false);
        }

        return $this->responseData(true, $mediaFileResponse['data']);
    }


}
