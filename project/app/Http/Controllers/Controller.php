<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function OkResponse(Collection|Model $model, string $alias = 'data'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'body' => [
                $alias => $model
            ]
        ]);
    }
    public function deleteResponse(){
        return response()->json([
           'status'=>true
        ]);
    }
}
