<?php

namespace App\Traits;

trait HttpResponses
{

    protected function sendResponse($data, $isSuccessful, $code, $message = null)
    {
        return response()->json([
            "successful" => $isSuccessful,
            "message" => $message,
            "payload" => $data
        ], $code);
    }

    // protected function error($data, $message = null, $code = 400)
    // {
    //     return response()->json([
    //         "successful" => false,
    //         "message" => $message,
    //         "payload" => $data
    //     ], $code);
    // }
}
