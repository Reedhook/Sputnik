<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    /**
     * Метод для создания матчей лотерейной игры
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'game_id' => 'required|integer|exists:lottery_games,id',
            'start_date' => 'required|date_format:Y:M:D',
            'start_time' => 'required|date_format:H:i',
        ]);
        $response = LotteryGameMatch::create($validated);
        $game = LotteryGameMatch::find($response['id']);
        return $this->OkResponse($game, 'lottery_game_matches');
    }
}
