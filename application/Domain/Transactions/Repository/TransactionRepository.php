<?php

namespace TheWallet\Transactions\Repository;

use Illuminate\Database\Eloquent\Collection;
use TheWallet\Transactions\DataTransferObject\TransactionData;
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

    public function getTransactions(int $walletSender, int $walletReceiver): Collection
    {
        return $this->model->where('sender', $walletSender)
            ->orWhere('receiver', $walletReceiver)
            ->get();
    }
}
