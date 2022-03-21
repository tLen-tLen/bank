<?php
namespace App\Services;

use App\Exceptions\InsufficientFundsException;
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

    /**
     * Получить информацию о счете
     *
     * @param int $accountId
     * @param string|null $currency
     * @return float
     */
    public static function getAccountAmount(int $accountId, ?string $currency): float
    {
        $result = 0;

        if (empty($currency)) {
            $currency = Account::find($accountId)->base_currency_id;
        } else {
            $currency = Currency::whereName($currency)->select('id')->first()->id;
        }

        $accountValues = AccountValues::where('account_id', $accountId)->select('currency_id', 'amount')->get();
        foreach ($accountValues as $value) {
            if ($value->currency_id != $currency) {
                $result += ConvertService::convert($value->currency_id, $currency, $value->amount);
            } else {
                $result += $value->amount;
            }
        }

        return $result;
    }

    /**
     * Изменение количества денег на счету
     *
     * @param int $accountId
     * @param string $currency
     * @param float $amount
     * @return float
     * @throws InsufficientFundsException
     */
    public static function changeAmount(int $accountId, string $currency, float $amount): float
    {
        $account = AccountValues::select('id', 'amount')
            ->where('account_id', $accountId)
            ->whereHas('currency', function ($query) use ($currency) {
                return $query->where('name', $currency);
            })
            ->first();

        if ($amount < 0 && abs($amount) > $account->amount){
            throw new InsufficientFundsException('Insufficient funds', 400);
        }

        $account->amount += $amount;
        $account->save();
        return $account->amount;
    }

    /**
     * Изменить основную валюту счета
     *
     * @param int $accountId
     * @param string $currency
     */
    public static function changeBaseCurrency(int $accountId, string $currency): void
    {
        $account = Account::select('id', 'base_currency_id')->whereId($accountId)->first();
        $account->base_currency_id = Currency::select('id')->whereName($currency)->first()->id;
        $account->save();
    }
}
