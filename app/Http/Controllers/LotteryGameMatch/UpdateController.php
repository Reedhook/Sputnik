<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Events\FinishedGameEvent;
use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \App\Http\Controllers\User\UpdateController as UserController;

class UpdateController extends Controller
{
    protected UserController $user;
    public function __construct(UserController $user)
    {
        $this->user = $user;
    }

    /**
     * Метод для завершения матча лотерейной игры
     * @param Request $request
     * @throws Exception
     */
    public function update(Request $request)
    {
        $game = LotteryGameMatch::findOrFail($request->route('lottery_game_match_id'));
        !$game['is_finished'] ?: throw new Exception('Матч уже закончен');
        $game->update([
            'is_finished' => true
        ]);
        event(new FinishedGameEvent($game));
        return $this->OkResponse(LotteryGameMatch::findOrFail($request->route('lottery_game_match_id')), 'lottery_game_match');
    }
}
