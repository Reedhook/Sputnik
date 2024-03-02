<?php

namespace App\Http\Controllers\LotteryGame;

use App\Http\Controllers\Controller;
use App\Models\LotteryGame;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Метод для получения списка всех лотерейных игр
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $games = LotteryGame::all();
        return $this->OkResponse($games, 'lottery_games' );
    }
}
