<?php

namespace TheWallet\Transactions;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheWallet\Wallets\Wallet;

class TransactionFactory extends Factory
{
    protected $model = TransactionFactory::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'sender' => Wallet::class,
            'receiver' => Wallet::class,
            'value' => rand(0, 1000),
            'situation' => 9
        ];
    }
}
