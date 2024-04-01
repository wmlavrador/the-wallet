<?php

use TheWallet\PaymentsAuthorizer\PaymentsAuthorizerServiceProvider;
use TheWallet\Transactions\TransactionRouteProvider;

return [
    App\Providers\AppServiceProvider::class,
    TransactionRouteProvider::class,
    PaymentsAuthorizerServiceProvider::class,
];
