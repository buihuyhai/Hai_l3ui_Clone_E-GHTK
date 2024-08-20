<?php
namespace Modules\Shop\Helpers;

use Illuminate\Http\JsonResponse;

trait ResponseTrait {
    /**
     * @param array $data
     * @param string $message
     * @return JsonResponse
     */
    public function successResponse(array $data = [], string $message = ''): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ]);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(string $message = '', int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => [],
            'message' => $message,
        ], $status);
    }
}
