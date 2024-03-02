<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lottery_game_matches', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id')->comment('Id лотерейной игры');
            $table->date('start_date')->comment('Дата начала матча');
            $table->time('start_time')->comment('Время начала матча');
            $table->integer('winner_id')->comment('Id пользователя, который победил')->nullable();
            $table->boolean('is_finished')->comment('Закончился ли матч')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('lottery_games')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_game_matches');
    }
};
