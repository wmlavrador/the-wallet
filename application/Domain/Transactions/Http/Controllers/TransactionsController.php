<?php

namespace TheWallet\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use TheWallet\Transactions\DataTransferObject\WalletsTransactionData;
use TheWallet\Transactions\Http\Requests\TransactionsIndexRequest;
use TheWallet\Transactions\Http\Requests\TransactionStore;
use TheWallet\Transactions\Http\Resources\TransactionsCollection;
use TheWallet\Transactions\UseCases\CreateTransactionUseCase;
use TheWallet\Transactions\UseCases\GetTransactionsUseCase;

class TransactionsController extends Controller
{
    public function __construct(
        private readonly CreateTransactionUseCase $createTransactionUseCase,
        private readonly GetTransactionsUseCase $listTransactionsUseCase
    ){}

    public function index(TransactionsIndexRequest $request): JsonResponse
    {
        $transactions = $this->listTransactionsUseCase->list($request->toDto());

        return response()->json(
            new TransactionsCollection($transactions)
        );
    }

    public function store(TransactionStore $request): JsonResponse
    {
        $this->createTransactionUseCase->handle($request->toDto());

        return response()->json([
            'success' => true,
            'message' => 'Transaction Created with Successfuly'
        ]);
    }
}
