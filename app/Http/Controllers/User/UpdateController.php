<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateController extends Controller
{


    /**
     * @throws Exception
     */
    public function update(Request $request): int|string
    {

        $validated = $this->validate($request,[
            'email' => 'email|string|max:255',
            Rule::unique('users')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore(auth()->id()),
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'is_admin' => 'boolean',
            'points' =>'integer'
        ]);
        /** Поиск записи по id, в Случае ошибки выкинет исключение 404 */
        $user = User::findOrFail(auth()->id());

        /** Обновить записи в базе данных данными прошедшими валидацию */
        $user->update($validated);

        /** Проверка на изменения данных модели */
        $newData = $user->getChanges();

        $newData?:throw new Exception('Данные не изменились');

        return $this->OkResponse(User::find(auth()->id()), 'user');

    }
}
