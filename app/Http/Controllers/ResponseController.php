<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseController extends Controller
{
    public function sendResponse($response, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($response, $code);
    }


    public function sendError($error, $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        $response = [
            'error' => $error,
        ];

        return response()->json($response, $code);
    }
}
