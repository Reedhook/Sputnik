<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\User;
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
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request): mixed
    {
        $game = LotteryGameMatch::findOrFail($request->route('lottery_game_match_id'));
        !$game['is_finished'] ?: throw new Exception('Матч уже закончен');
        $game->update([
            'winner_id' => random_int(0, User::count()),
            'is_finished' => true
        ]);
        $lottery_game = LotteryGame::findOrFail($game['game_id']);
        $this->user->update(new Request(['points'=>$lottery_game['reward_points']]));
        return $this->OkResponse(LotteryGameMatch::findOrFail($request->route('lottery_game_match_id')), 'lottery_game_match');
    }
}
