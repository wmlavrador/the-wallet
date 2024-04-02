<?php

namespace TheWallet\Transactions\Repository;

use Illuminate\Database\Eloquent\Collection;
use TheWallet\Transactions\DataTransferObject\TransactionData;
use TheWallet\Transactions\DataTransferObject\WalletsTransactionData;
use TheWallet\Transactions\Transaction;

class TransactionRepository
{
    public function __construct(
        private readonly Transaction $model
    ){}

    public function createTransaction(TransactionData $payload): Transaction
    {
        return $this->model->create([
            'sender' => $payload->sender,
            'receiver' => $payload->receiver,
            'value' => $payload->value,
            'situation' => $payload->situation
        ]);
    }

    public function getTransactions(WalletsTransactionData $walletsTransactionData): Collection
    {
        return $this->model->with('walletReceiver.user')
            ->where('sender', $walletsTransactionData->sender)
            ->orWhere('receiver', $walletsTransactionData->receiver)
            ->get();
    }
}
