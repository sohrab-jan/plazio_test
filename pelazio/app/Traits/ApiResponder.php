<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    protected function successResponse($data, $code = 200, $message = 'SUCCESS'): JsonResponse
    {
        $messages = [
            [
                'text' => $message,
                'type' => 'success'
            ]
        ];
        return response()->json([
            'success' => true,
            'messages' => $messages,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse($message, $code = 500, string $messageType = 'error'): JsonResponse
    {
        $messages = [
            [
                'text' => $message,
                'type' => $messageType
            ]
        ];

        return $this->errorWithMultipleMessages($messages, $code);
    }

    protected function errorWithMultipleMessages(array $messages, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'messages' => $messages,
        ], $code);
    }
}
