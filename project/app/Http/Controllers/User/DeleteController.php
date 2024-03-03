<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DeleteController extends Controller
{


    /**
     * Метод для удаления записи о пользователе
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function delete(Request $request): JsonResponse
    {
        $user = User::find(auth()->id());
        $user->delete();
        return $this->deleteResponse();
    }
}
