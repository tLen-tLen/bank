<?php
namespace App\Services;

use App\Models\Account;
use App\Models\AccountValues;
use App\Models\Currency;

/**
 * Класс для операция со счетами
 */
class AccountService
{
    /**
     * Создает новый счет клиента в банке
     *
     * @param int $clientId
     * @param int $bankId
     * @param string $baseCurrency
     * @param array $money
     * @return int
     */
    public static function createNewAccount(int $clientId, int $bankId, string $baseCurrency, array $money): int
    {
        $newAccount = Account::create([
            'client_id' => $clientId,
            'bank_id' => $bankId,
            'base_currency_id' => (int) Currency::where('name', $baseCurrency)->select('id')->first()->id
        ]);
        self::createAccountValues((int) $newAccount->id, $money);
        return $newAccount->id;
    }

    /**
     * Создает значения счетов под каждую валюту
     *
     * @param $account
     * @param $moneyArray
     */
    public static function createAccountValues(int $account, array $moneyArray): void
    {
        $currencyIds = [];
        Currency::whereIn('name', array_keys($moneyArray))->select('id', 'name')->get()->each(function ($item) use (&$currencyIds) {
            $currencyIds[$item->name] = $item->id;
        });

        foreach ($moneyArray as $currency => $money) {
            AccountValues::create([
                'account_id' => $account,
                'currency_id' => (int) $currencyIds[$currency],
                'amount' => $money
            ]);
        }
    }
}
