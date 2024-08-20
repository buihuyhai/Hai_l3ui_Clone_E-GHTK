<?php

namespace Modules\Media\Services\AwsS3;

use Aws\Exception\AwsException;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Modules\Core\Services\BaseService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Modules\Media\Helpers\FileHelper;

class MultipartUploaderToS3Service extends BaseService
{

    public function __construct()
    {
    }

    public function handle(UploadedFile $file, string $asset = 'assets', string $dir = 'Media')
    {
        if (!$file) return $this->responseData(false);

        $fileName = FileHelper::getFileName($file);
        $filePath = "{$asset}/{$dir}/{$fileName}";
        $contents = fopen($file, 'rb');

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION')
        ]);

        $uploader = new MultipartUploader($s3, $contents, [
            'bucket' => env('AWS_BUCKET'),
            'key'    => $filePath,
        ]);

        try {
            $result = $uploader->upload();
            return $this->responseData(true,
                [
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'url'       => $result['ObjectURL'],
                ]
            );
        } catch (MultipartUploadException $e) {
            return $this->responseData(false,
                [
                    'message' => ' Upload file Failed!',
                ]
            );
        } catch (AwsException $e) {
            return $this->responseData(false,
                [
                    'message' => "AWS: {$e->getMessage()}",
                ]
            );
        }
    }


}
