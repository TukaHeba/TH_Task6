<?php

namespace App\Http\Trait;

trait ApiResponseTrait
{
    public function customApi($data, $message, $status)
    {
        $array = [
            $data,
            $message
        ];
        return response()->json($array, $status);
    }
    public function errorApi($message, $status)
    {
        return response()->json($message, $status);
    }
}
