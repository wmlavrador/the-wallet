<?php

namespace TheWallet\PaymentsAuthorizer\Providers\Alelo;

use Illuminate\Support\Facades\Http;
use TheWallet\PaymentsAuthorizer\PaymentsAuthorizerContract;

class AleloClient implements PaymentsAuthorizerContract
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.payments_authorizer.alelo.api_url');
    }

    public function isAuthorizerPayment(): bool
    {
        return Http::get($this->apiUrl)->json('message') === 'Autorizado';
    }
}
