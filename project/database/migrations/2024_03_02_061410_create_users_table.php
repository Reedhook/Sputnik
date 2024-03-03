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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Id');
            $table->string('first_name')->comment('Имя');
            $table->string('email')->comment('email');
            $table->string('last_name')->comment('Фамилия');
            $table->boolean('is_admin')->default(false)->comment('Статус');
            $table->integer('points')->default(0)->comment('Очки');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
