<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AccountController extends Controller
{
    /**
     * Открытие мультивалютного счета
     *
     * @param CreateAccountRequest $request
     * @return JsonResponse
     */
    public function openAccount(CreateAccountRequest $request)
    {
        try {
            $newAccountId = AccountService::createNewAccount(
                $request->get('client'),
                $request->get('bank'),
                $request->get('base_currency'),
                [
                    'RUB' => $request->get('RUB'),
                    'USD' => $request->get('USD'),
                    'EUR' => $request->get('EUR'),
                ]
            );
            return response()->json([
                'status' => 'success',
                'account' => $newAccountId,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Получение данных о счете
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAccount(Request $request)
    {
        try {
            $amount = AccountService::getAccountAmount($request->get('account'), $request->get('currency'));
            return response()->json([
                'status' => 'success',
                'amount' => $amount,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Списание / пополенение счета
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeAmount(Request $request)
    {
        try {
            $newAmount = AccountService::changeAmount(
                $request->get('account'),
                $request->get('currency'),
                $request->get('amount')
            );
            return response()->json([
                'status' => 'success',
                'newAmount' => $newAmount
            ]);
        } catch (Throwable  $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Изменить основную валюту счета
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeBaseCurrency(Request $request)
    {
        try {
            AccountService::changeBaseCurrency(
                $request->get('account'),
                $request->get('currency')
            );
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Throwable  $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
