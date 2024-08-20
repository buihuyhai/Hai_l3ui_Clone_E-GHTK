<?php

namespace Modules\Core\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseApiTrait
{
    protected function responseBadRequest(string $message = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status'  => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST);
    }

    protected function responseSuccess($data, string $message = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data'    => $data,
            'status'  => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    protected function responseNotFound(string $message = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status'  => Response::HTTP_NOT_FOUND
        ], Response::HTTP_NOT_FOUND);
    }
}
