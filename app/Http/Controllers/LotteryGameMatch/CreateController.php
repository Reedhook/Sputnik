<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function store(Request $request)
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
