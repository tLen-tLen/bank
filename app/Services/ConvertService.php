<?php


namespace App\Services;


use App\Models\Course;

/**
 * Сервис конвертации
 * @package App\Services
 */
class ConvertService
{
    /**
     * Конвертация валют
     *
     * @param int $from
     * @param int $to
     * @param float $amount
     * @return float
     */
    public static function convert(int $from, int $to, float $amount): float
    {
        $course = Course::where([
            'currency_from_id' => $from,
            'currency_to_id' => $to,
        ])->select('amount')->first()->amount;
        return $course * $amount;
    }
}
