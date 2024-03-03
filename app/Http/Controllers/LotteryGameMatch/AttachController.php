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
        $game = LotteryGameMatch::findOrFail($request->route('lottery_game_match_id'));
        !$game['is_finished'] ?: throw new Exception('Матч уже закончен');
        $user = User::find(auth()->id());
        event(new RecordUsersToGameEvent($game, $user));

        $user->lottery_game_matches()->attach($game);
        return response()->json(['status'=>true]);
    }
}
