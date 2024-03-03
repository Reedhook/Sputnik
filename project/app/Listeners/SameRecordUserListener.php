<?php

namespace App\Listeners;

use App\Events\RecordUsersToGameEvent;
use Exception;

class SameRecordUserListener
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
        if ($user->lottery_game_matches()->where('lottery_game_match_id', $game['id'])->exists()){
            throw new Exception('Попытка повторной записи на один и тот же матч');
        }
    }
}
