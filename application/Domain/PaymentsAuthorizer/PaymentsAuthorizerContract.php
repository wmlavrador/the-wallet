<?php

namespace TheWallet\PaymentsAuthorizer;

interface PaymentsAuthorizerContract
{
    public function isAuthorizerPayment(): bool;
}
