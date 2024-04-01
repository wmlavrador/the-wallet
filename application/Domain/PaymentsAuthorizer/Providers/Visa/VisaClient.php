<?php

namespace TheWallet\PaymentsAuthorizer\Providers\Visa;

use Illuminate\Support\Facades\Http;
use TheWallet\PaymentsAuthorizer\PaymentsAuthorizerContract;

class VisaClient implements PaymentsAuthorizerContract
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.payments_authorizer.visa.api_url');
    }

    public function isAuthorizerPayment(): bool
    {
        return Http::get($this->apiUrl)->json('message') === 'Autorizado';
    }
}
