<?php

namespace App\Events;

use App\Models\LotteryGameMatch;
use App\Models\User;

class RecordUsersToGameEvent extends Event
{
    public LotteryGameMatch $game;
    public User $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LotteryGameMatch $game, User $user)
    {
        $this->game=$game;
        $this->user=$user;

    }
}
