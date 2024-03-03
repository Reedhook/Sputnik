<?php

namespace App\Listeners;

use App\Events\FinishedGameEvent;
use App\Events\RecordUsersToGameEvent;
use App\Models\LotteryGame;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class WinnerListener
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
     * @param FinishedGameEvent $event
     * @return void
     */
    public function handle(FinishedGameEvent $event)
    {
        $game = $event->game;
        $users = $game->users()->get();
        $winners = [];
        foreach ($users as $user) {
            $winners [] = $user['id'];
        }
        $game->update([
            'winner_id' => $winners[array_rand($winners)]
        ]);
        $lottery_game = LotteryGame::find($game['game_id']);
        $user = User::find($game['winner_id']);
        $user->update([
            'points' => $lottery_game['reward_points']
        ]);
    }
}
