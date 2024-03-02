<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function OkResponse(Model $model, string $alias = 'data')
    {
        return response()->json([
            'status' => true,
            'body'=>[
                $alias=>[
                    $model
                ]
            ]
        ]);
    }
}
