<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttachController extends Controller
{
    /**
     * Метод для записи пользователя на игру
     * @return void
     * @throws ValidationException
     */
    public function record(Request $request)
    {
        $game = LotteryGameMatch::findOrFail($request->route('lottery_game_match_id'));

        $user = User::find(auth()->id());
        $user->lottery_game_matches()->attach($game);
    }
}
