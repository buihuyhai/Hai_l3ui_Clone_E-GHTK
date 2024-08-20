<?php

namespace Modules\User\Traits;

use Illuminate\Foundation\Http\FormRequest as Request;
use Illuminate\Support\Facades\Hash;
use Modules\Media\Services\File\UploadFileService;
use Illuminate\Support\Str;

trait UserRequestTrait
{
    protected UploadFileService $uploadFileService;

    protected function getFullName(Request $request): string
    {
        return "{$request->first_name} {$request->last_name}";
    }

    protected function getFilePath(Request $request): string
    {
        if (!$request->file('avatar')) return '';

        $response = $this->uploadFileService->handle($request->file('avatar'), 'Admin', 'Avatars');

        if (!$response['status']) return '';

        return $response['data']['file_path'];
    }

    protected function getPassword(Request $request): string
    {
        return Hash::make($request->password);
    }

    protected function getRequestOrRandomPassword(Request $request): string
    {
        return Hash::make($request->password ?? Str::random(8));
    }

    protected function getRequestData(Request $request): array
    {
        $data = [
            "name"     => $this->getFullName($request),
            "password" => $this->getPassword($request),
        ];

        if ($avatar = $this->getFilePath($request))
            $data['avatar'] = $avatar;

        return $data;
    }

    protected function getRequestOrRandomData(Request $request): array
    {
        $data = [
            ...($this->getRequestData($request)),
            "password" => $this->getRequestOrRandomPassword($request),
        ];

        return $data;
    }


}
