<?php

namespace App\Http\Controllers\LotteryGameMatch;

use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    /**
     * Метод для создания матчей лотерейной игры
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        // Валидация данных
        $validated = $this->validate($request, [
            'game_id' => 'required|integer|exists:lottery_games,id',
            'start_date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
        ]);


        //Объединяем дату и время, введенные пользователем
        $startDateTimeString = $validated['start_date'] . ' ' . $validated['start_time'];

        // Создаем объект DateTime для введенной пользователем даты и времени
        $startDateTime = new DateTime($startDateTimeString);

        // Создаем объект DateTime для текущей даты и времени
        $currentDateTime = new DateTime();

        // Сравниваем введенную дату и время с текущей датой и временем
        ($startDateTime > $currentDateTime) ?: throw new Exception('Этот день уже закончился');
        $response = LotteryGameMatch::create($validated);
        $game = LotteryGameMatch::find($response['id']);
        return $this->OkResponse($game, 'lottery_game_match');
    }
}
