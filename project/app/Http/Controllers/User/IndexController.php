<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $query = User::with(['lottery_game_matches' => function ($query) {
            $query->whereColumn('lottery_game_matches.winner_id', 'lottery_game_match_users.user_id');
        }])->get();

        return $this->OkResponse($query, 'users');
    }

}
