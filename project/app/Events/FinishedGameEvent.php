<?php

namespace App\Events;

use App\Models\LotteryGameMatch;

class FinishedGameEvent extends Event
{
    public LotteryGameMatch $game;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LotteryGameMatch $game)
    {
        $this->game=$game;
    }
}
