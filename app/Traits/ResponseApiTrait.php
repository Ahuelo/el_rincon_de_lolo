<?php

namespace App\Traits;

trait ResponseApiTrait{
    public function successResponse(mixed $data, string $message, int $code=200){
        return response()->json([
            'message'=> $message,
            'data' => $data
        ], $code);
    }

}
