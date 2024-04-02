<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TheWallet\Users\User;
use TheWallet\Wallets\Wallet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Wallet::factory(10)->create();
    }
}
