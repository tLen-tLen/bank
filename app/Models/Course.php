<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Курс
 * @package App\Models
 *
 * @property int $currency_from_id
 * @property int $currency_to_id
 * @property double $amount
 */
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_from_id',
        'currency_to_id',
        'amount'
    ];

    /**
     * Конвертируемая валюта
     *
     * @return BelongsTo
     */
    public function currency_from_id()
    {
        return $this->belongsTo(Currency::class, 'currency_from_id');
    }

    /**
     * Валюта, в которую конвертируем
     *
     * @return BelongsTo
     */
    public function currency_to_id()
    {
        return $this->belongsTo(Currency::class, 'currency_to_id');
    }
}
