<?php

namespace TheWallet\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use TheWallet\Transactions\Http\Requests\TransactionStore;
use TheWallet\Transactions\UseCases\CreateTransactionUseCase;

class TransactionsController extends Controller
{
    public function __construct(
        private readonly CreateTransactionUseCase $transactionUseCase
    ){}

    public function store(TransactionStore $request): JsonResponse
    {
        $this->transactionUseCase->handle($request->toDto());

        return response()->json([
            'success' => true,
            'message' => 'Transaction Created with Successfuly'
        ]);
    }
}
