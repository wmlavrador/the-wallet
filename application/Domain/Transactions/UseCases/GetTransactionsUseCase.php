<?php

namespace TheWallet\Transactions\UseCases;

use Illuminate\Database\Eloquent\Collection;
use TheWallet\Transactions\DataTransferObject\WalletsTransactionData;
use TheWallet\Transactions\Repository\TransactionRepository;

class GetTransactionsUseCase
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ){}

    public function list(WalletsTransactionData $walletsTransactionData): Collection
    {
        return $this->transactionRepository->getTransactions($walletsTransactionData);
    }

}
