<?php

namespace TheWallet\Transactions;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use TheWallet\Transactions\Http\Controllers\TransactionsController;

class TransactionRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->controller(TransactionsController::class)->group(function(){
            Route::post('my-transactions', 'index')->name('transactions.index');
            Route::post('transactions', 'store')->name('transactions.store');
        });
    }
}
