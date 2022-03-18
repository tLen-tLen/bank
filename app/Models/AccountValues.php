<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Суммы на счету
 * @package App\Models
 *
 * @property int $account_id
 * @property int $currency_id
 * @property double $amount
 */
class AccountValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'currency_id',
        'amount'
    ];

    /**
     * Счет
     *
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * Валюта
     *
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
