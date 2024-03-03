<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Метод для получения списка всех лотерейных игр
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if(isset($request['lottery_game_id'])){
            $game = LotteryGameMatch::where('game_id', $request['lottery_game_id'])->get();

            return $this->OkResponse($game, 'lottery_game');
        }
        return $this->OkResponse(LotteryGameMatch::all(), 'lottery_game_matches' );
    }
}
