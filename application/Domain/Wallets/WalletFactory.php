<?php

namespace TheWallet\Wallets;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheWallet\Users\User;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'user_id' => User::factory(),
            'balance' => rand(0, 100000),
        ];
    }
}
