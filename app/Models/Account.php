<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Счет
 * @package App\Models
 *
 * @property int $client_id
 * @property int $bank_id
 * @property int $base_currency_id
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'bank_id',
        'base_currency_id'
    ];

    /**
     * Клиент
     *
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Основная валюта счета
     *
     * @return BelongsTo
     */
    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }

    /**
     * Банк
     *
     * @return BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
