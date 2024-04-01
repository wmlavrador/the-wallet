<?php

namespace TheWallet\PaymentsAuthorizer;

class PaymentsAuthorizerException extends \Exception
{
    public static function paymentAuthorizerNotImplemented(string $authorizerName): self
    {
        return new self(sprintf(
            'Provider %s not implemented, sorry',
            $authorizerName
        ));
    }
}
