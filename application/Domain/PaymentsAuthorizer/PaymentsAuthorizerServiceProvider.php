<?php

namespace TheWallet\PaymentsAuthorizer;

use Illuminate\Support\ServiceProvider;
use TheWallet\PaymentsAuthorizer\Enum\PaymentsAuthorizerImplementedEnum;
use TheWallet\PaymentsAuthorizer\Providers\Alelo\AleloClient;
use TheWallet\PaymentsAuthorizer\Providers\Visa\VisaClient;

class PaymentsAuthorizerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(PaymentsAuthorizerContract::class, function($app){
            $authorizer = $app['config']['payments_authorizer.default'];

            return match ($authorizer) {
                PaymentsAuthorizerImplementedEnum::Alelo->value => new AleloClient(),
                PaymentsAuthorizerImplementedEnum::Visa->value => new VisaClient(),
                default => throw PaymentsAuthorizerException::paymentAuthorizerNotImplemented($authorizer)
            };
        });
    }
}
