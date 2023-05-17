<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

class JsonResponseHelper
{
    public static function jsonResponse($data, $code = 200) : JsonResponse { 
        return response()->json([
            'data' => $data,
        ], $code);
    }
}