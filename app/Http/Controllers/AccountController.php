<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

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
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }

    }
}
