<?php

namespace project\database\seeders;

use App\Models\LotteryGame;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class LotteryGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Log::info(1);
            LotteryGame::factory()->create();
        }
    }
}
