<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{


    /**
     * Метод для регистрации новых пользователей
     * @throws ValidationException
     * @throws Exception
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'email' => 'required|email|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'is_admin' => 'boolean'
        ]);
        $response = User::create($validated) ?: throw new Exception('Создать пользователя не дуалось');
        $user = User::find($response['id']);
        return $this->OkResponse($user, 'user');
    }
}
