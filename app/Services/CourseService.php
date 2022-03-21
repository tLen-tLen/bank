<?php


namespace App\Services;


use App\Models\Course;

/**
 * Сервис для работы с курсом валют
 * @package App\Services
 */
class CourseService
{
    /**
     * Установить новый курс валют
     *
     * @param string $from
     * @param string $to
     * @param float $amount
     */
    public static function setNewCourse(string $from, string $to, float $amount): void
    {
        $courseItem = Course::select('id', 'amount')->whereHas('currency_from_id', function ($query) use ($from) {
            return $query->where('name', $from);
        })->whereHas('currency_to_id', function ($query) use ($to) {
            return $query->where('name', $to);
        })->first();
        $courseItem->amount = $amount;
        $courseItem->save();
    }
}
