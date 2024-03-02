<?php

namespace App\Listeners;

use App\Events\RecordUsersToGameEvent;
use App\Models\LotteryGame;
use Exception;
use Illuminate\Support\Facades\DB;

class MaxCountUsersListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\RecordUsersToGameEvent $event
     * @return void
     * @throws Exception
     */
    public function handle(RecordUsersToGameEvent $event)
    {
        $user = $event->user;
        $game = $event->game;
        $lottery_game = LotteryGame::find($game['game_id']);
        $games = DB::table('lottery_game_match_users')->where('lottery_game_match_id')->count();
        !($lottery_game['gamer_count'] >= $games) ?: throw new Exception('Свободные места закончились');
        $user->lottery_game_matches()->attach($game);
    }
}
