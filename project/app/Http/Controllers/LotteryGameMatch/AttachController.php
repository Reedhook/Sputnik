<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Events\RecordUsersToGameEvent;
use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttachController extends Controller
{
    /**
     * Метод для записи пользователя на игру
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function record(Request $request)
    {
        $game = LotteryGameMatch::findOrFail($request->route('lottery_game_match_id')); // Поиск по id, Model или Exception
        !$game['is_finished'] ?: throw new Exception('Матч уже закончен'); // Проверка на успешность операции
        $user = User::find(auth()->id()); // Поиск по id
        event(new RecordUsersToGameEvent($game, $user)); // создаем событие

        $user->lottery_game_matches()->attach($game); // связываем
        return response()->json(['status'=>true]);
    }
}
