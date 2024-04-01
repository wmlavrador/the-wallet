<?php

namespace TheWallet\Wallets\Repository;

use TheWallet\Wallets\Wallet;

class WalletRepository
{
    public function __construct(
        private readonly Wallet $model
    ){}

    public function getWalletById(string $walletId): Wallet
    {
        return $this->model->find($walletId);
    }

    public function increaseBalance(Wallet $wallet, int $value): bool|int
    {
        return $wallet->increment('balance', $value);
    }

    public function decreaseBalance(Wallet $wallet, int $value): bool|int
    {
        return $wallet->decrement('balance', $value);
    }
}
